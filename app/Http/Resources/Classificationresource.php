<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassificationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'order'      => $this->order,
            'icon_class' => $this->icon_class,
            // El nombre viene de la traducción cargada según el idioma del request
            'name'       => $this->translations->first()?->classification_name ?? null,
            'group'      => new ClassificationGroupResource(
                $this->whenLoaded('classificationGroup')
            ),
        ];
    }
}
