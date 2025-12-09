<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coleccion;
use Illuminate\Support\Facades\Storage;

class ColeccionesController extends Controller
{
    public function index()
    {
        // Obtener todas las colecciones con sus juegos relacionados
        $coleccions = Coleccion::with('juegos')->get();
        return response()->json($coleccions);
    }

    public function create()
    {
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo coleccion
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        // Ruta relativa en storage/app/public
        $rutaRelativa = 'colecciones/default.jpg';

        // URL pública
        $imagenColeccion = asset('storage/' . $rutaRelativa);

        $coleccion = Coleccion::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'usuario_id' => $request->usuario_id,
            'imagen' => $imagenColeccion, // Guarda la URL completa
        ]);

        return response()->json([
            'message' => 'Coleccion creada exitosamente',
            'coleccion' => $coleccion,
        ], 201);
    }

    public function show($id)
    {
        // Obtener la colección con sus juegos relacionados
        $coleccion = Coleccion::with('juegos')->find($id);

        if (!$coleccion) {
            return response()->json([
                'message' => 'Colección no encontrada',
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
            return response()->json(['message' => 'Coleccion no encontrada'], 404);
        }

        // Validar los campos básicos
        $coleccion->update($request->only(['nombre', 'descripcion']));

        // Validar y procesar la nueva imagen
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');

            if (!$file->isValid()) {
                return response()->json(['message' => 'Archivo no válido'], 400);
            }

            $rutaImagen = $file->store('colecciones', 'public');

            if (!$rutaImagen) {
                return response()->json(['message' => 'store() devolvió null'], 500);
            }

            $coleccion->imagen = asset('storage/' . $rutaImagen);
        }

        $coleccion->save();

        return response()->json([
            'message' => 'Coleccion actualizada exitosamente',
            'coleccion' => $coleccion,
        ]);
    }

    public function destroy($id)
    {
        $coleccion = Coleccion::find($id);

        if (!$coleccion) {
            return response()->json([
                'message' => 'Coleccion no encontrada',
            ], 404);
        }

        // Eliminar relaciones con juegos
        $coleccion->juegos()->detach();

        // Eliminar imagen si no es la default
        if ($coleccion->imagen && !str_contains($coleccion->imagen, 'default.jpg')) {
            $rutaAnterior = str_replace(asset('storage/'), '', $coleccion->imagen);
            Storage::disk('public')->delete($rutaAnterior);
        }

        // Eliminar colección
        $coleccion->delete();

        return response()->json([
            'message' => 'Coleccion eliminada exitosamente',
        ]);
    }

    // Obtener colecciones de un usuario específico
    public function coleccionesDeUsuario($usuarioId)
    {
        // Obtener todas las colecciones de un usuario específico
        $colecciones = Coleccion::with('juegos')
            ->where('usuario_id', $usuarioId)
            ->get();

        return response()->json($colecciones);
    }

    // Añadir un juego a la colección
    public function agregarJuego($coleccionId, $juegoId)
    {
        $coleccion = Coleccion::findOrFail($coleccionId);
        $coleccion->juegos()->syncWithoutDetaching([$juegoId]);

        return response()->json([
            'message' => 'Juego añadido a la colección',
            'coleccion' => $coleccion->load('juegos')
        ]);
    }

    // Quitar un juego de la colección
    public function quitarJuego($coleccionId, $juegoId)
    {
        $coleccion = Coleccion::findOrFail($coleccionId);
        $coleccion->juegos()->detach($juegoId);

        return response()->json([
            'message' => 'Juego eliminado de la colección',
            'coleccion' => $coleccion->load('juegos')
        ]);
    }
}
