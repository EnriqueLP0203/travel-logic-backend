<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'order' => $this->order,
            'name'  => $this->translations->first()?->name ?? null,
            'image' => $this->img_compound_name
                ? [
                    'file'      => $this->img_compound_name,
                    'extension' => $this->img_extension,
                ]
                : null,
        ];
    }
}
