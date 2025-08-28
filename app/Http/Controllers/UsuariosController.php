<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use IlluminateSupport\Facades\Auth;

use function Laravel\Prompts\password;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        return response()->json($usuarios);
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo usuario
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:usuarios,nick',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:6'
        ]);

        // Ruta relativa en storage/app/public
        $rutaRelativa = 'perfiles/fotoPredeterminada.jpg';

        // URL pública
        $fotoPerfilUrl = asset('storage/' . $rutaRelativa);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'nick' => $request->nick,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => 'usuario',
            'foto_perfil' => $fotoPerfilUrl, // Guarda la URL completa
        ]);

        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'usuario' => $usuario,
        ], 201);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        return response()->json($usuario);
    }

    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un usuario específico
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $data = $request->only(['nombre', 'nick', 'email']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('foto_perfil')) {
            $request->validate([
                'foto_perfil' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=800,max_height=800',
            ]);

            // borrar la anterior si no es la predeterminada
            if ($usuario->foto_perfil && !str_contains($usuario->foto_perfil, 'fotoPredeterminada.jpg')) {
                $rutaAnterior = str_replace(asset('storage/'), '', $usuario->foto_perfil);
                Storage::disk('public')->delete($rutaAnterior);
            }

            // guardar la nueva en storage/app/public/perfiles
            $rutaImagen = $request->file('foto_perfil')->store('perfiles', 'public');

            // generar URL pública para React
            $data['foto_perfil'] = asset('storage/' . $rutaImagen);
        }

        $usuario->update($data);
        $usuario->refresh();

        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'usuario' => $usuario,
        ]);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado exitosamente',
        ]);
    }

    // Autenticación de usuarios

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (!$usuario || !Hash::check($request->password, $usuario->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'usuario' => $usuario,
        ]);
    }
}
