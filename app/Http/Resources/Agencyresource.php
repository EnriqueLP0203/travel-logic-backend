<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgencyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'comercial_name'  => $this->comercial_name,
            'business_name'   => $this->business_name,
            'logo'            => $this->logo_path,
            'website'         => $this->website,
            'email'           => $this->email,
            'phone'           => $this->phone,
            'location'        => [
                'address' => $this->address,
                'city'    => $this->city,
                'state'   => $this->state,
                'country' => $this->country,
            ],
            'bio'    => $this->bio,
            'active' => (bool) $this->active,

            // Hoteles de la agencia solo si la relación fue cargada
            'hotels' => HotelListResource::collection(
                $this->whenLoaded('hotels')
            ),
        ];
    }
}
