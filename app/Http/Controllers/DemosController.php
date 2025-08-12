<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;

class DemosController extends Controller
{
    public function index()
    {
        return response()->json(Demo::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg|max:2048|dimensions:width=600,height=900',
            'mainScript' => 'required|string',
            'juego_id' => 'required|exists:juegos,id|unique:demos,juego_id',
            'carpeta_demo' => 'required|file|mimes:zip',
        ]);

        $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            // Guardar imagen en demos/portadas
            $rutaImagen = $request->file('imagen')->store('demos/portadas', 'public');
        }

        // Subir y descomprimir ZIP
        $zipPath = $request->file('carpeta_demo')->store('demos_zips', 'public');
        $storagePath = storage_path('app/public');
        $zip = new \ZipArchive;

        if ($zip->open($storagePath . '/' . $zipPath) === true) {
            $folderName = pathinfo($zipPath, PATHINFO_FILENAME);
            $extractPath = $storagePath . '/demos/' . $folderName;
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            return response()->json(['message' => 'Error al descomprimir el archivo.'], 500);
        }

        // Guardar demo
        $demo = Demo::create([
            'nombre' => $request->nombre,
            'imagen' => $rutaImagen ? asset('storage/' . $rutaImagen) : null,
            'mainScript' => asset("storage/demos/{$folderName}/" . $request->mainScript),
            'juego_id' => $request->juego_id,
        ]);

        $juego = \App\Models\Juego::find($request->juego_id);
        if ($juego) {
            $juego->update(['tiene_demo' => true]);
        }

        return response()->json([
            'message' => 'Demo creada correctamente.',
            'demo' => $demo,
        ], 201);
    }

    public function show($id)
    {
        $demo = Demo::find($id);

        if (!$demo) {
            return response()->json(['message' => 'Demo no encontrada'], 404);
        }

        return response()->json($demo);
    }

    public function update(Request $request, $id)
    {
        $demo = Demo::find($id);

        if (!$demo) {
            return response()->json(['message' => 'Demo no encontrada'], 404);
        }

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpg,jpeg|max:2048|dimensions:width=600,height=900',
            'mainScript' => 'sometimes|required|string',
            'juego_id' => 'sometimes|required|exists:juegos,id|unique:demos,juego_id,' . $id,
            'carpeta_demo' => 'nullable|file|mimes:zip',
        ]);

        $oldJuegoId = $demo->juego_id;

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('demos/portadas', 'public');
            $demo->imagen = asset('storage/' . $rutaImagen);
        }

        if ($request->hasFile('carpeta_demo')) {
            $zipPath = $request->file('carpeta_demo')->store('demos_zips', 'public');
            $storagePath = storage_path('app/public');
            $zip = new \ZipArchive;

            if ($zip->open($storagePath . '/' . $zipPath) === true) {
                $folderName = pathinfo($zipPath, PATHINFO_FILENAME);
                $extractPath = $storagePath . '/demos/' . $folderName;
                $zip->extractTo($extractPath);
                $zip->close();

                if ($request->has('mainScript')) {
                    $demo->mainScript = asset("storage/demos/{$folderName}/" . $request->mainScript);
                }
            } else {
                return response()->json(['message' => 'Error al descomprimir el archivo.'], 500);
            }
        }

        $demo->update(collect($validated)->except(['carpeta_demo', 'mainScript'])->toArray());

        if ($request->has('mainScript') && !isset($folderName)) {
            $folderName = basename(dirname(parse_url($demo->mainScript, PHP_URL_PATH)));
            $demo->mainScript = asset("storage/demos/{$folderName}/" . $request->mainScript);
            $demo->save();
        }

        // Si cambió el juego_id, actualizamos el tiene_demo de ambos juegos
        if ($request->filled('juego_id') && $oldJuegoId != $request->juego_id) {
            if ($oldJuego = \App\Models\Juego::find($oldJuegoId)) {
                $oldJuego->update(['tiene_demo' => false]);
            }
            if ($newJuego = \App\Models\Juego::find($request->juego_id)) {
                $newJuego->update(['tiene_demo' => true]);
            }
        }

        return response()->json(['message' => 'Demo actualizada', 'demo' => $demo]);
    }

    public function destroy($id)
    {
        $demo = Demo::find($id);

        if (!$demo) {
            return response()->json(['message' => 'Demo no encontrada'], 404);
        }

        // Actualiza el juego relacionado
        $juego = \App\Models\Juego::find($demo->juego_id);
        if ($juego) {
            $juego->update(['tiene_demo' => false]);
        }

        $demo->delete();

        return response()->json(['message' => 'Demo eliminada']);
    }
}
