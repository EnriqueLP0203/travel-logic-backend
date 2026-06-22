<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Versión completa del hotel para la vista de detalle.
 * Incluye traducción según idioma del request (Accept-Language header),
 * galería, clasificaciones, agencias y reseñas aprobadas.
 */
class HotelResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Resuelve el idioma desde el header Accept-Language
        // Ejemplo: "es-MX" o "en-US". Por defecto usa es-MX.
        $langCode = $this->resolveLanguageCode($request);

        // Busca la traducción correcta de las ya cargadas
        $translation = $this->whenLoaded('translations', function () use ($langCode) {
            return $this->translations->firstWhere('language_code', $langCode);
        });

        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'slug'          => $this->slug,
            'star_category' => $this->star_category,
            'star_rating'   => (float) $this->star_rating,
            'price_range'   => $this->price_range,
            'featured'      => (bool) $this->featured,
            'is_published'  => (bool) $this->is_published,

            'contact' => [
                'phone'   => $this->phone,
                'email'   => $this->email,
                'website' => $this->website,
            ],

            'location' => [
                'address'     => $this->address,
                'postal_code' => $this->postal_code,
                'latitude'    => (float) $this->latitude,
                'longitude'   => (float) $this->longitude,
            ],

            // Contenido traducido según idioma del request
            'content' => $translation
                ? new HotelTranslationResource($translation)
                : null,

            // Destino al que pertenece
            'destination' => new DestinationResource(
                $this->whenLoaded('destination')
            ),

            // Galería completa de imágenes
            'gallery' => HotelGalleryResource::collection(
                $this->whenLoaded('gallery')
            ),

            // Clasificaciones del hotel (Todo incluido, Familias, etc.)
            'classifications' => ClassificationResource::collection(
                $this->whenLoaded('classifications')
            ),

            // Agencias que pueden agendar este hotel
            'agencies' => AgencyResource::collection(
                $this->whenLoaded('agencies')
            ),
        ];
    }

    /**
     * Resuelve el código de idioma desde el header Accept-Language.
     * Soporta: es-MX, en-US. Fallback: es-MX.
     */
    private function resolveLanguageCode(Request $request): string
    {
        $supported = ['es-MX', 'en-US'];
        $header    = $request->header('Accept-Language', 'es-MX');

        // Intenta match exacto primero (ej. "es-MX")
        foreach ($supported as $lang) {
            if (str_contains($header, $lang)) {
                return $lang;
            }
        }

        // Intenta match parcial por prefijo (ej. "es" → "es-MX")
        $prefix = substr($header, 0, 2);
        foreach ($supported as $lang) {
            if (str_starts_with(strtolower($lang), strtolower($prefix))) {
                return $lang;
            }
        }

        return 'es-MX';
    }
}
