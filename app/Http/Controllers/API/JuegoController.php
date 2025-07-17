<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\JuegoResource;
use App\Models\Juego;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;

class JuegoController extends Controller implements HasMiddleware
{
    public $modelclass = Juego::class;

    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Juego::query(); // o algo similar
        return JuegoResource::collection($query->paginate($request->perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Juego::class);

        $juegoData = json_decode($request->getContent(), true);

        $juego = Juego::create($juegoData);

        return new JuegoResource($juego);
    }

    /**
     * Display the specified resource.
     */
    public function show(Juego $juego)
    {
        return new JuegoResource($juego);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Juego $juego)
    {
        Gate::authorize('update', $juego);

        $juegoData = json_decode($request->getContent(), true);
        $juego->update($juegoData);

        return new JuegoResource($juego);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Juego $juego)
    {
        Gate::authorize('delete', $juego);
        try {
            $juego->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()], 400);
        }
    }
}