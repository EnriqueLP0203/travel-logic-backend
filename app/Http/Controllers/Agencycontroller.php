<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AgencyResource;
use App\Models\Agency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AgencyController extends Controller
{
    /**
     * Listado de agencias activas (requiere autenticación).
     * GET /api/agencies
     */
    public function index(): AnonymousResourceCollection
    {
        $agencies = Agency::where('active', true)
            ->orderBy('comercial_name')
            ->get();

        return AgencyResource::collection($agencies);
    }

    /**
     * Detalle de una agencia con sus hoteles (requiere autenticación).
     * GET /api/agencies/{id}
     */
    public function show(int $id): AgencyResource|JsonResponse
    {
        $agency = Agency::where('id', $id)
            ->where('active', true)
            ->with([
                'hotels' => fn($q) => $q
                    ->where('active', true)
                    ->where('is_published', true)
                    ->with('gallery', 'destination'),
            ])
            ->first();

        if (! $agency) {
            return response()->json(['message' => 'Agencia no encontrada.'], 404);
        }

        return new AgencyResource($agency);
    }
}
