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
            'franquicia_id' => 'required|exists:franquicias,id',
            'tiene_demo' => 'boolean',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('portadas', 'public');
        }

        $tieneDemo = $request->boolean('tiene_demo', false);

        $juego = Juego::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha_lanzamiento' => $request->input('fecha_lanzamiento'),
            'plataforma' => $request->input('plataforma'),
            'genero' => $request->input('genero'),
            'autor' => $request->input('autor'),
            'imagen' => $rutaImagen ? asset('storage/' . $rutaImagen) : null,
            'franquicia_id' => $request->input('franquicia_id'),
            'tiene_demo' => $tieneDemo,
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

    }

    public function update(Request $request, $id)
    {
        $juego = Juego::find($id);

        if (!$juego) {
            return response()->json([
                'message' => 'Juego no encontrado',
            ], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|string|max:50',
            'descripcion' => 'sometimes|string',
            'fecha_lanzamiento' => 'sometimes|date',
            'plataforma' => 'sometimes|string|max:50',
            'genero' => 'sometimes|string|max:50',
            'autor' => 'sometimes|string|max:50',
            'imagen' => 'nullable|image|mimes:jpg,jpeg|max:2048|dimensions:width=600,height=900',
            'franquicia_id' => 'sometimes|exists:franquicias,id',
            'tiene_demo' => 'boolean',
        ]);

        $juego->update($validated);

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

    public function juegosPorFranquicia($id)
    {
        $franquicia = \App\Models\Franquicia::where('id', $id)->first();

        if (!$franquicia) {
            return response()->json(['message' => 'Franquicia no encontrada'], 404);
        }

        return response()->json($franquicia->juegos);
    }

    public function demoPorJuego($id)
    {
        $juego = \App\Models\Juego::with('demo')->find($id);

        if (!$juego) {
            return response()->json(['message' => 'Juego no encontrado'], 404);
        }

        if (!$juego->demo) {
            return response()->json(['message' => 'Este juego no tiene demo.'], 404);
        }

        return response()->json($juego->demo);
    }
}
