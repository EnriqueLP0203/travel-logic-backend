<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassificationGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // El nombre se resuelve desde la traducción cargada
        // Si no hay traducción cargada, queda null
        $translation = $this->whenLoaded('translations');

        return [
            'id'     => $this->id,
            'order'  => $this->order,
            'name'   => $this->translations->first()?->classification_group_name ?? null,
            'image'  => $this->img_compound_name
                ? [
                    'file'      => $this->img_compound_name,
                    'extension' => $this->img_extension,
                ]
                : null,
            'classifications' => ClassificationResource::collection(
                $this->whenLoaded('classifications')
            ),
        ];
    }
}
