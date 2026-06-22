<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LanguageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'code'         => $this->code,
            'symbol'       => $this->symbol,
            'default_lang' => (bool) $this->default_lang,
            'active'       => (bool) $this->active,
        ];
    }
}
