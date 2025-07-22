<?php

namespace App\Http\Controllers;

use App\Models\Franquicia;
use Illuminate\Http\Request;

class FranquiciasController extends Controller
{
    public function index()
    {
        return response()->json(Franquicia::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'imagen' => 'required|image|mimes:jpg,jpeg|max:2048',
            'logo' => 'required|image|mimes:png|max:2048|dimensions:width=500,height=500',
        ]);

        $franquicia = Franquicia::create($request->all());

        return response()->json([
            'message' => 'Franquicia creada con éxito',
            'franquicia' => $franquicia
        ], 201);
    }

    public function show($id)
    {
        $franquicia = Franquicia::find($id);

        if (!$franquicia) {
            return response()->json(['message' => 'Franquicia no encontrada'], 404);
        }

        return response()->json($franquicia);
    }

    public function update(Request $request, $id)
    {
        $franquicia = Franquicia::find($id);

        if (!$franquicia) {
            return response()->json(['message' => 'Franquicia no encontrada'], 404);
        }

        $franquicia->update($request->all());

        return response()->json([
            'message' => 'Franquicia actualizada',
            'franquicia' => $franquicia
        ]);
    }

    public function destroy($id)
    {
        $franquicia = Franquicia::find($id);

        if (!$franquicia) {
            return response()->json(['message' => 'Franquicia no encontrada'], 404);
        }

        $franquicia->delete();

        return response()->json(['message' => 'Franquicia eliminada']);
    }
}
