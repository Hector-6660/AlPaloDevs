<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use App\Models\Franquicia;
use Illuminate\Http\Request;

class PersonajesController extends Controller
{
    public function index()
    {
        return response()->json(Personaje::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|url',
            'franquicia_id' => 'required|exists:franquicias,id',
        ]);

        $personaje = Personaje::create($request->all());

        return response()->json([
            'message' => 'Personaje creado con éxito',
            'personaje' => $personaje
        ], 201);
    }

    public function show($id)
    {
        $personaje = Personaje::find($id);

        if (!$personaje) {
            return response()->json(['message' => 'Personaje no encontrado'], 404);
        }

        return response()->json($personaje);
    }

    public function update(Request $request, $id)
    {
        $personaje = Personaje::find($id);

        if (!$personaje) {
            return response()->json(['message' => 'Personaje no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|url',
            'franquicia_id' => 'sometimes|required|exists:franquicias,id',
        ]);

        $personaje->update($request->all());

        return response()->json([
            'message' => 'Personaje actualizado',
            'personaje' => $personaje
        ]);
    }

    public function destroy($id)
    {
        $personaje = Personaje::find($id);

        if (!$personaje) {
            return response()->json(['message' => 'Personaje no encontrado'], 404);
        }

        $personaje->delete();

        return response()->json(['message' => 'Personaje eliminado']);
    }

    /**
     * Muestra todos los personajes de una franquicia específica.
     */
    public function personajesPorFranquicia($id)
    {
        $franquicia = \App\Models\Franquicia::where('id', $id)->first();

        if (!$franquicia) {
            return response()->json(['message' => 'Franquicia no encontrada'], 404);
        }

        return response()->json($franquicia->personajes);
    }
}
