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
            'descripcion' => 'nullable|string',
            'imagen' => 'required|image|mimes:jpg,jpeg|max:2048|dimensions:width=600,height=900',
            'logo' => 'required|image|mimes:png|max:2048|dimensions:width=500,height=500',
        ]);

        $imagenRuta = $request->file('imagen')->store('franquicias/portadas', 'public');
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
            'imagen' => 'nullable|image|mimes:jpg,jpeg|max:2048|dimensions:width=600,height=900',
            'logo' => 'nullable|image|mimes:png|max:2048|dimensions:width=500,height=500',
        ]);

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('franquicias/portadas', 'public');
            $franquicia->imagen = asset('storage/' . $rutaImagen);
        }

        if ($request->hasFile('logo')) {
            $rutaLogo = $request->file('logo')->store('franquicias/logos', 'public');
            $franquicia->logo = asset('storage/' . $rutaLogo);
        }

        $franquicia->update($request->except(['imagen', 'logo']));

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
