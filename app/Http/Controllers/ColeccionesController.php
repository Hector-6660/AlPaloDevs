<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coleccion;

class ColeccionesController extends Controller
{
    public function index()
    {
        $coleccions = Coleccion::all();

        return response()->json($coleccions);
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo coleccion
    }

    public function store(Request $request)
    {
        $coleccion = Coleccion::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'fecha_creacion' => $request->input('fecha_creacion'),
            'usuario_id' => $request->input('usuario_id'),
        ]);

        return response()->json([
            'message' => 'Coleccion creado exitosamente',
            'coleccion' => $coleccion,
        ], 201);
    }

    public function show($id)
    {
        $coleccion = Coleccion::find($id);

        if (!$coleccion) {
            return response()->json([
                'message' => 'Coleccion no encontrado',
            ], 404);
        }

        return response()->json($coleccion);
    }

    public function edit($id)
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un coleccion específico
    }

    public function update(Request $request, $id)
    {
        $coleccion = Coleccion::find($id);

        if (!$coleccion) {
            return response()->json([
                'message' => 'Coleccion no encontrado',
            ], 404);
        }

        $coleccion->update($request->only(['nombre', 'descripcion', 'fecha_creacion']));

        return response()->json([
            'message' => 'Coleccion actualizado exitosamente',
            'coleccion' => $coleccion,
        ]);
    }

    public function destroy($id)
    {
        $coleccion = Coleccion::find($id);

        if (!$coleccion) {
            return response()->json([
                'message' => 'Coleccion no encontrado',
            ], 404);
        }

        $coleccion->delete();

        return response()->json([
            'message' => 'Coleccion eliminado exitosamente',
        ]);
    }
}
