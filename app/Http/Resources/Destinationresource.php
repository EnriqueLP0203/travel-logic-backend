<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->id,
            'city'    => $this->city,
            'state'   => $this->state,
            'country' => $this->country,
            'slug'    => $this->slug,
            'active'  => (bool) $this->active,
            'image'   => $this->img_compound_name
                ? [
                    'file'      => $this->img_compound_name,
                    'extension' => $this->img_extension,
                    'size'      => $this->img_file_size,
                ]
                : null,

            // Hoteles del destino solo se incluyen si la relación fue cargada
            'hotels'  => HotelListResource::collection(
                $this->whenLoaded('hotels')
            ),
        ];
    }
}
