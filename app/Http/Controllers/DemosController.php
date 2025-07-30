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
            'mainScript' => 'required|string',
            'juego_id' => 'required|exists:juegos,id|unique:demos,juego_id',
            'carpeta_demo' => 'required|file|mimes:zip',
        ]);

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
            'mainScript' => asset("storage/demos/{$folderName}/" . $request->mainScript),
            'juego_id' => $request->juego_id,
        ]);

        $juego = \App\Models\Juego::find($request->juego_id);
        $juego->tiene_demo = true;
        $juego->save();

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

        $request->validate([
            'nombre' => 'sometimes|required|string|max:255',
            'mainScript' => 'sometimes|required|string',
            'juego_id' => 'sometimes|required|exists:juegos,id|unique:demos,juego_id,' . $id,
            'carpeta_demo' => 'nullable|file|mimes:zip',
        ]);

        if ($request->hasFile('carpeta_demo')) {
            $zipPath = $request->file('carpeta_demo')->store('demos_zips', 'public');
            $storagePath = storage_path('app/public');
            $zip = new \ZipArchive;

            if ($zip->open($storagePath . '/' . $zipPath) === true) {
                $folderName = pathinfo($zipPath, PATHINFO_FILENAME);
                $extractPath = $storagePath . '/demos/' . $folderName;
                $zip->extractTo($extractPath);
                $zip->close();

                $demo->mainScript = asset("storage/demos/{$folderName}/" . $request->mainScript);
            } else {
                return response()->json(['message' => 'Error al descomprimir el archivo.'], 500);
            }
        }

        $demo->update($request->except('carpeta_demo', 'mainScript'));

        if ($request->has('mainScript')) {
            $folderName ??= basename(dirname(parse_url($demo->mainScript, PHP_URL_PATH)));
            $demo->mainScript = asset("storage/demos/{$folderName}/" . $request->mainScript);
            $demo->save();
        }

        return response()->json(['message' => 'Demo actualizada', 'demo' => $demo]);
    }

    public function destroy($id)
    {
        $demo = Demo::find($id);

        if (!$demo) {
            return response()->json(['message' => 'Demo no encontrada'], 404);
        }

        $demo->delete();

        return response()->json(['message' => 'Demo eliminada']);
    }
}
