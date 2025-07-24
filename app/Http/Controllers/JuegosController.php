<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juego;

class JuegosController extends Controller
{
    public function index()
    {
        $juegos = Juego::all();

        return response()->json($juegos);
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo juego
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string',
            'fecha_lanzamiento' => 'required|date',
            'plataforma' => 'required|string|max:50',
            'genero' => 'required|string|max:50',
            'autor' => 'required|string|max:50',
            'imagen' => 'nullable|image|mimes:jpg,jpeg|max:2048|dimensions:width=600,height=900',
            'franquicia_nombre' => 'required|string|max:100',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('portadas', 'public');
        }

        $juego = Juego::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha_lanzamiento' => $request->input('fecha_lanzamiento'),
            'plataforma' => $request->input('plataforma'),
            'genero' => $request->input('genero'),
            'autor' => $request->input('autor'),
            'imagen' => $rutaImagen ? asset('storage/' . $rutaImagen) : null,
            'franquicia_nombre' => $request->input('franquicia_nombre'),
        ]);

        return response()->json([
            'message' => 'Juego creado exitosamente',
            'juego' => $juego,
        ], 201);
    }

    public function show($id)
    {
        $juego = Juego::find($id);

        if (!$juego) {
            return response()->json([
                'message' => 'Juego no encontrado',
            ], 404);
        }

        return response()->json($juego);
    }

    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un juego específico
    }

    public function update(Request $request, $id)
    {
        $juego = Juego::find($id);

        if (!$juego) {
            return response()->json([
                'message' => 'Juego no encontrado',
            ], 404);
        }

        $juego->update($request->all());

        return response()->json([
            'message' => 'Juego actualizado exitosamente',
            'juego' => $juego,
        ]);
    }

    public function destroy($id)
    {
        $juego = Juego::find($id);

        if (!$juego) {
            return response()->json([
                'message' => 'Juego no encontrado',
            ], 404);
        }

        $juego->delete();

        return response()->json([
            'message' => 'Juego eliminado exitosamente',
        ]);
    }
}
