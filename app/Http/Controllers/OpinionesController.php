<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opinion;

class OpinionesController extends Controller
{
    public function index()
    {
        $opinions = Opinion::all();

        return response()->json($opinions);
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo opinion
    }

    public function store(Request $request)
    {
        $opinion = Opinion::create([
            'titulo' => $request->input('titulo'),
            'contenido' => $request->input('contenido'),
            'puntuacion' => $request->input('puntuacion'),
            'fecha_creacion' => $request->input('fecha_creacion'),
            'usuario_id' => $request->input('usuario_id'),
            'juego_id' => $request->input('juego_id'),
        ]);

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
        $opinion = Opinion::find($id);

        if (!$opinion) {
            return response()->json([
                'message' => 'Opinion no encontrado',
            ], 404);
        }

        $opinion->update($request->only(['nombre', 'descripcion', 'fecha_creacion']));

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
}
