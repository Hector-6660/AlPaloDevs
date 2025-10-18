<?php

namespace App\Http\Controllers;

use App\Models\Franquicia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'descripcion' => 'nullable|string',
            'imagen' => 'required|image|mimes:jpg,jpeg|max:2048|dimensions:width=4000,height=2635',
            'logo' => 'required|image|mimes:png|max:2048|dimensions:width=500,height=500',
        ]);

        $imagenRuta = $request->file('imagen')->store('franquicias', 'public');
        $logoRuta = $request->file('logo')->store('franquicias/logos', 'public');

        $franquicia = Franquicia::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => asset('storage/' . $imagenRuta),
            'logo' => asset('storage/' . $logoRuta),
        ]);

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

        $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg|max:2048',
            'logo' => 'nullable|image|mimes:png|max:2048',
        ]);

        // Si suben nueva imagen: borrar la antigua y guardar la nueva
        if ($request->hasFile('imagen')) {
            if ($franquicia->imagen) {
                // Extraer ruta relativa "franquicias/archivo.jpg" desde la URL"
                $oldPath = parse_url($franquicia->imagen, PHP_URL_PATH);
                $oldPath = preg_replace('#^/storage/#', '', $oldPath);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }

            $rutaImagen = $request->file('imagen')->store('franquicias', 'public');
            $franquicia->imagen = asset('storage/' . $rutaImagen);
        }

        // Si suben nuevo logo: borrar el antiguo y guardar el nuevo
        if ($request->hasFile('logo')) {
            if ($franquicia->logo) {
                $oldLogoPath = parse_url($franquicia->logo, PHP_URL_PATH);
                $oldLogoPath = preg_replace('#^/storage/#', '', $oldLogoPath);
                if ($oldLogoPath && Storage::disk('public')->exists($oldLogoPath)) {
                    Storage::disk('public')->delete($oldLogoPath);
                }
            }

            $rutaLogo = $request->file('logo')->store('franquicias/logos', 'public');
            $franquicia->logo = asset('storage/' . $rutaLogo);
        }

        // Actualizar el resto de campos y guardar todo
        $franquicia->fill($request->except(['imagen', 'logo']));
        $franquicia->save();

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

        // Borrar imagen
        if ($franquicia->imagen) {
            $imagenPath = parse_url($franquicia->imagen, PHP_URL_PATH);
            $imagenPath = preg_replace('#^/storage/#', '', $imagenPath);
            if ($imagenPath && Storage::disk('public')->exists($imagenPath)) {
                Storage::disk('public')->delete($imagenPath);
            }
        }

        // Borrar logo
        if ($franquicia->logo) {
            $logoPath = parse_url($franquicia->logo, PHP_URL_PATH);
            $logoPath = preg_replace('#^/storage/#', '', $logoPath);
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
        }

        $franquicia->delete();

        return response()->json(['message' => 'Franquicia eliminada']);
    }
}
