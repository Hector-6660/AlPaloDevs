<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

use function Laravel\Prompts\password;

class UsuarioController extends Controller
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
        $usuario = Usuario::create([
            'nombre' => $request->input('nombre'),
            'nick' => $request->input('nick'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'rol' => 'usuario',
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
            return response()->json([
                'message' => 'Usuario no encontrado',
            ], 404);
        }

        $usuario->update($request->only(['nombre', 'nick', 'email', 'password']));

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
}
