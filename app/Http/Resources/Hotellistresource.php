<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Versión compacta del hotel para listados.
 * Solo expone: nombre, slug, rating, imagen principal y destino.
 */
class HotelListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Imagen principal de la galería
        $principal = $this->gallery
            ? $this->gallery->firstWhere('is_principal', true)
            : null;

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'star_category' => $this->star_category,
            'star_rating'   => (float) $this->star_rating,
            'featured'      => (bool) $this->featured,

            // Imagen principal del hotel
            'image' => $principal
                ? [
                    'file'      => $principal->compound_name,
                    'extension' => $principal->extension,
                    'mime_type' => $principal->mime_type,
                ]
                : null,

            // Destino resumido
            'destination' => $this->whenLoaded('destination', fn() => [
                'id'      => $this->destination->id,
                'city'    => $this->destination->city,
                'state'   => $this->destination->state,
                'country' => $this->destination->country,
                'slug'    => $this->destination->slug,
            ]),
        ];
    }
}
