<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelTranslationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'language_code'     => $this->language_code,
            'short_description' => $this->short_description,
            'description'       => $this->description,
            'amenities'         => $this->amenities,
            'meta'              => [
                'title'       => $this->meta_title,
                'description' => $this->meta_description,
                'keywords'    => $this->meta_keywords,
            ],
        ];
    }
}
