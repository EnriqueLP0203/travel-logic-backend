<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'public_photo' => $this->public_photo,
            'country'      => $this->country,
            'city'         => $this->city,
        ];
    }
}
