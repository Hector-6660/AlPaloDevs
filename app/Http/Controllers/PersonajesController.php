<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use App\Models\Franquicia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'imagen' => 'nullable|image|mimes:png|max:2048|dimensions:width=150,height=350',
            'franquicia_id' => 'required|exists:franquicias,id',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('personajes', 'public');
        }

        $personaje = Personaje::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $rutaImagen ? asset('storage/' . $rutaImagen) : null,
            'franquicia_id' => $request->franquicia_id,
        ]);

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
            'imagen' => 'nullable|image|mimes:png|max:2048|dimensions:width=150,height=350',
            'franquicia_id' => 'sometimes|required|exists:franquicias,id',
        ]);

        // 🔁 Si se sube una nueva imagen, borramos la anterior
        if ($request->hasFile('imagen')) {
            if ($personaje->imagen) {
                $oldPath = parse_url($personaje->imagen, PHP_URL_PATH);
                $oldPath = preg_replace('#^/storage/#', '', $oldPath);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $rutaImagen = $request->file('imagen')->store('personajes', 'public');
            $personaje->imagen = asset('storage/' . $rutaImagen);
        }

        $personaje->update($request->except('imagen'));

        return response()->json([
            'message' => 'Personaje actualizado con éxito',
            'personaje' => $personaje
        ]);
    }

    public function destroy($id)
    {
        $personaje = Personaje::find($id);

        if (!$personaje) {
            return response()->json(['message' => 'Personaje no encontrado'], 404);
        }

        // 🗑️ Eliminar imagen asociada
        if ($personaje->imagen) {
            $path = parse_url($personaje->imagen, PHP_URL_PATH);
            $path = preg_replace('#^/storage/#', '', $path);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }

        $personaje->delete();

        return response()->json(['message' => 'Personaje eliminado con éxito']);
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
