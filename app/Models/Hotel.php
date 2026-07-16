<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hotel extends Model
{
    protected $table = 'hotels';

    public $timestamps = true;

    protected $fillable = [
        'destination_id',
        'name',
        'star_category',
        'address',
        'postal_code',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'star_rating',
        'price_range',
        'featured',
        'is_published',
        'hotel_detail_id',
        'hotel_code',
        'supplier_id',
        'supplier_name',
        'slug',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'star_rating' => 'decimal:1',
        'featured' => 'boolean',
        'is_published' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * Destino al que pertenece el hotel.
     */
    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    /**
     * Todas las traducciones del hotel (descripción, amenities, SEO).
     */
    public function translations(): HasMany
    {
        return $this->hasMany(HotelTranslation::class, 'hotel_id');
    }

    /**
     * Traducción del hotel para un idioma específico.
     * Uso: $hotel->translation('es-MX')
     */
    public function translation(string $languageCode = 'es-MX'): HasOne
    {
        return $this->hasOne(HotelTranslation::class, 'hotel_id')
            ->where('language_code', $languageCode);
    }

    /**
     * Imágenes del hotel.
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(HotelGallery::class, 'hotel_id');
    }

    /**
     * Imagen principal del hotel.
     */
    public function principalImage(): HasOne
    {
        return $this->hasOne(HotelGallery::class, 'hotel_id')
            ->where('is_principal', true);
    }

    /**
     * Reseñas del hotel.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(HotelReview::class, 'hotel_id');
    }

    /**
     * Solo reseñas aprobadas (las que se muestran públicamente).
     */
    public function approvedReviews(): HasMany
    {
        return $this->hasMany(HotelReview::class, 'hotel_id')
            ->where('status', 'approved');
    }

    /**
     * Agencias que pueden gestionar reservas para este hotel.
     */
    public function agencies(): BelongsToMany
    {
        return $this->belongsToMany(
            Agency::class,
            'agencies_hotels',
            'hotel_id',
            'agency_id'
        );
    }

    /**
     * Grupos de hotel asociados (Playa, Ciudad, Lujo, etc).
     */
    public function hotelGroups(): BelongsToMany
    {
        return $this->belongsToMany(
            HotelGroup::class,
            'hotels_hotel_groups',
            'hotel_id',
            'hotel_group_id'
        );
    }

    /**
     * Tipos de alojamiento asociados (Todo Incluido, Familias, etc).
     */
    public function accommodationTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            AccommodationType::class,
            'hotels_accommodation_types',
            'hotel_id',
            'accommodation_type_id'
        );
    }
}
