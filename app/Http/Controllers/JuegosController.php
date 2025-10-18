<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juego;
use Illuminate\Support\Facades\Storage;

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
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=600,max_height=900',
            'franquicia_id' => 'nullable|integer',
            'tiene_demo' => 'boolean',
        ]);

        // Guardar imagen en storage/app/public/portadas
        $rutaImagen = $request->file('imagen')->store('portadas', 'public');

        // Crear URL pública
        $imagenUrl = asset('storage/' . $rutaImagen);

        $juego = Juego::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'plataforma' => $request->plataforma,
            'genero' => $request->genero,
            'autor' => $request->autor,
            'imagen' => $imagenUrl,
            'franquicia_id' => $request->franquicia_id,
            'tiene_demo' => $request->boolean('tiene_demo', false),
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
            return response()->json(['message' => 'Juego no encontrado'], 404);
        }

        $request->validate([
            'nombre' => 'sometimes|string|max:50',
            'descripcion' => 'sometimes|string',
            'fecha_lanzamiento' => 'sometimes|date',
            'plataforma' => 'sometimes|string|max:50',
            'genero' => 'sometimes|string|max:50',
            'autor' => 'sometimes|string|max:50',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions:max_width=600,max_height=900',
            'franquicia_id' => 'nullable|integer',
            'tiene_demo' => 'boolean',
        ]);

        $data = $request->only([
            'nombre', 'descripcion', 'fecha_lanzamiento',
            'plataforma', 'genero', 'autor', 'franquicia_id', 'tiene_demo'
        ]);

        // Si hay nueva imagen
        if ($request->hasFile('imagen')) {
            // borrar la anterior si existe
            if ($juego->imagen && !str_contains($juego->imagen, 'default.jpg')) {
                $rutaAnterior = str_replace(asset('storage/'), '', $juego->imagen);
                Storage::disk('public')->delete($rutaAnterior);
            }

            // guardar nueva imagen
            $rutaImagen = $request->file('imagen')->store('portadas', 'public');
            $data['imagen'] = asset('storage/' . $rutaImagen);
        }

        $juego->update($data);

        return response()->json([
            'message' => 'Juego actualizado exitosamente',
            'juego' => $juego,
        ]);
    }

    public function destroy($id)
    {
        $juego = Juego::find($id);

        if (!$juego) {
            return response()->json(['message' => 'Juego no encontrado'], 404);
        }

        // Eliminar imagen si existe
        if ($juego->imagen && !str_contains($juego->imagen, 'default.jpg')) {
            $rutaAnterior = str_replace(asset('storage/'), '', $juego->imagen);
            Storage::disk('public')->delete($rutaAnterior);
        }

        $juego->delete();

        return response()->json(['message' => 'Juego eliminado exitosamente']);
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

    public function ultimoJuego()
    {
        $juego = Juego::orderBy('id', 'desc')->first();

        if (!$juego) {
            return response()->json(['message' => 'No hay juegos aún'], 404);
        }

        return response()->json($juego);
    }
}
