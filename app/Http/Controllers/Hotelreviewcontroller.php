<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HotelReviewResource;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HotelReviewController extends Controller
{
    /**
     * Reseñas aprobadas de un hotel (público).
     * GET /api/hotels/{slug}/reviews
     */
    public function index(string $slug): AnonymousResourceCollection|JsonResponse
    {
        $hotel = Hotel::where('slug', $slug)
            ->where('active', true)
            ->where('is_published', true)
            ->first();

        if (! $hotel) {
            return response()->json(['message' => 'Hotel no encontrado.'], 404);
        }

        $reviews = $hotel->approvedReviews()
            ->with('traveler')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return HotelReviewResource::collection($reviews);
    }
}
