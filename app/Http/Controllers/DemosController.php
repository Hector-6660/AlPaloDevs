<?php

namespace App\Http\Controllers;

use App\Models\Demo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        // Subir ZIP
        $zipPath = $request->file('carpeta_demo')->store('demos_zips', 'public');
        $storagePath = storage_path('app/public');
        $zip = new \ZipArchive;

        // Descomprimir ZIP
        if ($zip->open($storagePath . '/' . $zipPath) === true) {
            $folderName = pathinfo($zipPath, PATHINFO_FILENAME);
            $extractPath = $storagePath . '/demos/' . $folderName;
            $zip->extractTo($extractPath);
            $zip->close();

            // Si el ZIP tiene una única carpeta raíz, movemos su contenido un nivel arriba
            $firstFolder = glob($extractPath . '/*', GLOB_ONLYDIR);
            if (count($firstFolder) === 1) {
                $innerFolder = $firstFolder[0];
                foreach (glob($innerFolder . '/*') as $file) {
                    $targetPath = $extractPath . '/' . basename($file);
                    rename($file, $targetPath);
                }
                // Borramos la carpeta vacía
                rmdir($innerFolder);
            }
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

        // Eliminar el ZIP subido (ya descomprimido)
        Storage::disk('public')->delete($zipPath);

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

        // Actualizar imagen si se sube una nueva
        if ($request->hasFile('imagen')) {
            // Borrar la anterior si existe
            if ($demo->imagen) {
                $oldImagePath = str_replace(asset('storage/'), '', $demo->imagen);
                Storage::disk('public')->delete($oldImagePath);
            }

            // Guardar la nueva imagen
            $rutaImagen = $request->file('imagen')->store('demos/portadas', 'public');
            $demo->imagen = asset('storage/' . $rutaImagen);
        }

        // Si viene un nuevo ZIP, reemplazamos la carpeta vieja
        if ($request->hasFile('carpeta_demo')) {
            // Borrar carpeta anterior si existe
            if ($demo->mainScript) {
                $oldFolder = basename(dirname(parse_url($demo->mainScript, PHP_URL_PATH)));
                Storage::disk('public')->deleteDirectory('demos/' . $oldFolder);
            }

            // Subir ZIP nuevo
            $zipPath = $request->file('carpeta_demo')->store('demos_zips', 'public');
            $storagePath = storage_path('app/public');
            $zip = new \ZipArchive;

            // Descomprimir ZIP
            if ($zip->open($storagePath . '/' . $zipPath) === true) {
                $folderName = pathinfo($zipPath, PATHINFO_FILENAME);
                $extractPath = $storagePath . '/demos/' . $folderName;
                $zip->extractTo($extractPath);
                $zip->close();

                // Si el ZIP tiene una única carpeta raíz, movemos su contenido un nivel arriba
                $firstFolder = glob($extractPath . '/*', GLOB_ONLYDIR);
                if (count($firstFolder) === 1) {
                    $innerFolder = $firstFolder[0];
                    foreach (glob($innerFolder . '/*') as $file) {
                        $targetPath = $extractPath . '/' . basename($file);
                        rename($file, $targetPath);
                    }
                    // Borramos la carpeta vacía
                    rmdir($innerFolder);
                }

                // Establecer ruta pública del archivo indicado
                $demo->mainScript = asset("storage/demos/{$folderName}/" . ($request->mainScript ?? 'main.js'));
            } else {
                return response()->json(['message' => 'Error al descomprimir el archivo.'], 500);
            }

            // Borrar el ZIP subido
            Storage::disk('public')->delete($zipPath);
        }

        // Actualizar los demás campos (sin carpeta_demo ni mainScript)
        $demo->fill(collect($validated)->except(['carpeta_demo', 'mainScript', 'imagen'])->toArray());
        $demo->save();

        // Si solo cambió el nombre del mainScript (sin subir nuevo ZIP)
        if ($request->has('mainScript') && !isset($folderName)) {
            $folderName = basename(dirname(parse_url($demo->mainScript, PHP_URL_PATH)));
            $demo->mainScript = asset("storage/demos/{$folderName}/" . $request->mainScript);
            $demo->save();
        }

        // Si cambió el juego asociado, actualizar banderas tiene_demo
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
        if (!$demo) return response()->json(['message' => 'Demo no encontrada'], 404);

        // Actualizar el juego relacionado
        $juego = \App\Models\Juego::find($demo->juego_id);
        if ($juego) $juego->update(['tiene_demo' => false]);

        // Eliminar imagen
        if ($demo->imagen) {
            $oldPath = str_replace(asset('storage/'), '', $demo->imagen);
            Storage::disk('public')->delete($oldPath);
        }

        // Eliminar carpeta de la demo
        if ($demo->mainScript) {
            $folder = basename(dirname(parse_url($demo->mainScript, PHP_URL_PATH)));
            Storage::disk('public')->deleteDirectory('demos/' . $folder);
        }

        $demo->delete();

        return response()->json(['message' => 'Demo eliminada correctamente']);
    }
}
