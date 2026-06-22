<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelReviewResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'review_text' => $this->review_text,

            'ratings' => [
                'overall'     => (float) $this->rating_overall,
                'cleanliness' => $this->rating_cleanliness,
                'service'     => $this->rating_service,
                'location'    => $this->rating_location,
                'facilities'  => $this->rating_facilities,
                'value'       => $this->rating_value,
            ],

            'status'   => $this->status,
            'traveler' => new TravelerResource($this->whenLoaded('traveler')),

            // Respuesta del admin solo si existe
            'admin_response' => $this->admin_response
                ? [
                    'text' => $this->admin_response,
                    'date' => $this->admin_response_date,
                ]
                : null,

            'created_at' => $this->created_at,
        ];
    }
}
