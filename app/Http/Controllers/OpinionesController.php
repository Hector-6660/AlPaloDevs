<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opinion;

class OpinionesController extends Controller
{
    public function index()
    {
        $opinions = Opinion::with(['usuario', 'juego'])->get();

        return response()->json($opinions);
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo opinion
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'contenido' => 'required|string|max:1000',
            'puntuacion' => 'required|integer|min:0|max:100',
            'usuario_id' => 'required|exists:usuarios,id',
            'juego_id' => 'required|exists:juegos,id',
        ]);

        $opinion = Opinion::create([
            'titulo' => $request->input('titulo'),
            'contenido' => $request->input('contenido'),
            'puntuacion' => $request->input('puntuacion'),
            'usuario_id' => $request->input('usuario_id'),
            'juego_id' => $request->input('juego_id'),
        ]);

        $opinion->refresh();

        return response()->json([
            'message' => 'Opinion creado exitosamente',
            'opinion' => $opinion,
        ], 201);
    }

    public function show($id)
    {
        $opinion = Opinion::find($id);

        if (!$opinion) {
            return response()->json([
                'message' => 'Opinion no encontrado',
            ], 404);
        }

        return response()->json($opinion);
    }

    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un opinion específico
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:100',
            'contenido' => 'required|string|max:1000',
            'puntuacion' => 'required|integer|min:0|max:100',
        ]);

        $opinion = Opinion::find($id);

        if (!$opinion) {
            return response()->json([
                'message' => 'Opinion no encontrado',
            ], 404);
        }

        $opinion->update($request->only(['titulo', 'contenido', 'puntuacion']));
        $opinion->refresh();

        return response()->json([
            'message' => 'Opinion actualizado exitosamente',
            'opinion' => $opinion,
        ]);
    }

    public function destroy($id)
    {
        $opinion = Opinion::find($id);

        if (!$opinion) {
            return response()->json([
                'message' => 'Opinion no encontrado',
            ], 404);
        }

        $opinion->delete();

        return response()->json([
            'message' => 'Opinion eliminado exitosamente',
        ]);
    }

    // Buscar opinión por usuario y juego
    public function buscarPorUsuarioYJuego(Request $request)
    {
        $usuarioId = $request->query('usuario_id');
        $juegoId = $request->query('juego_id');

        $opinion = Opinion::where('usuario_id', $usuarioId)
                        ->where('juego_id', $juegoId)
                        ->first();

        if (!$opinion) {
            return response()->json(null, 200);
        }

        return response()->json($opinion);
    }

    // Obtener opiniones de un juego específico
    public function opinionsPorJuego($id)
    {
        $opinions = Opinion::where('juego_id', $id)
            ->with('usuario')
            ->get();

        if ($opinions->isEmpty()) {
            return response()->json([
                'message' => 'No hay opiniones para este juego aún',
                'opinions' => []
            ], 200);
        }

        return response()->json($opinions);
    }
}
