<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelGalleryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'file'         => $this->compound_name,
            'original'     => $this->original_name,
            'mime_type'    => $this->mime_type,
            'extension'    => $this->extension,
            'size'         => $this->file_size,
            'is_principal' => (bool) $this->is_principal,
        ];
    }
}
