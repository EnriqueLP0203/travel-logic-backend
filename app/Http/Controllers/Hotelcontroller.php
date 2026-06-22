<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyResource;
use App\Http\Resources\HotelListResource;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HotelController extends Controller
{
    /**
     * Listado de hoteles publicados con filtros opcionales.
     * GET /api/hotels
     *
     * Query params opcionales:
     *   ?destination={slug}
     *   ?featured=1
     *   ?star_category=5
     *   ?classification={id}
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = Hotel::where('active', true)
            ->where('is_published', true)
            ->with(['destination', 'gallery']);

        // Filtro por destino
        if ($request->filled('destination')) {
            $query->whereHas(
                'destination',
                fn($q) =>
                $q->where('slug', $request->destination)
            );
        }

        // Filtro por destacados
        if ($request->boolean('featured')) {
            $query->where('featured', true);
        }

        // Filtro por categoría de estrellas
        if ($request->filled('star_category')) {
            $query->where('star_category', $request->integer('star_category'));
        }

        // Filtro por clasificación (Todo incluido, Familias, etc.)
        if ($request->filled('classification')) {
            $query->whereHas(
                'classifications',
                fn($q) =>
                $q->where('classifications.id', $request->integer('classification'))
            );
        }

        $hotels = $query->orderBy('featured', 'desc')
            ->orderBy('star_rating', 'desc')
            ->paginate(20);

        return HotelListResource::collection($hotels);
    }

    /**
     * Detalle completo de un hotel (público).
     * GET /api/hotels/{slug}
     */
    public function show(Request $request, string $slug): HotelResource|JsonResponse
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('active', true)
            ->where('is_published', true)
            ->with([
                'destination',
                'translations',
                'gallery',
                'classifications.translations',
                'classifications.classificationGroup.translations',
            ])
            ->first();

        if (! $hotel) {
            return response()->json(['message' => 'Hotel no encontrado.'], 404);
        }

        return new HotelResource($hotel);
    }

    /**
     * Agencias disponibles para un hotel (requiere autenticación).
     * GET /api/hotels/{slug}/agencies
     */
    public function agencies(Request $request, string $slug): AnonymousResourceCollection|JsonResponse
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('active', true)
            ->where('is_published', true)
            ->first();

        if (! $hotel) {
            return response()->json(['message' => 'Hotel no encontrado.'], 404);
        }

        $agencies = $hotel->agencies()
            ->where('active', true)
            ->get();

        return AgencyResource::collection($agencies);
    }
}
