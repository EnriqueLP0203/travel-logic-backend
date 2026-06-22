<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DestinationController extends Controller
{
    /**
     * Listado de destinos activos.
     * GET /api/destinations
     */
    public function index(): AnonymousResourceCollection
    {
        $destinations = Destination::where('active', true)
            ->orderBy('city')
            ->get();

        return DestinationResource::collection($destinations);
    }

    /**
     * Detalle de un destino con sus hoteles publicados.
     * GET /api/destinations/{slug}
     */
    public function show(string $slug): DestinationResource|JsonResponse
    {
        $destination = Destination::where('slug', $slug)
            ->where('active', true)
            ->with([
                'hotels' => fn($q) => $q
                    ->where('active', true)
                    ->where('is_published', true)
                    ->with('gallery'),
            ])
            ->first();

        if (! $destination) {
            return response()->json(['message' => 'Destino no encontrado.'], 404);
        }

        return new DestinationResource($destination);
    }
}
