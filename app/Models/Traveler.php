<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Traveler extends Model
{
    protected $table = 'travelers';

    public $timestamps = true;

    protected $fillable = [
        'travelers_auth_id',
        'first_name',
        'last_name',
        'gender',
        'phone',
        'country',
        'city',
        'public_photo',
        'newsletter',
        'active',
    ];

    protected $casts = [
        'newsletter' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * Cuenta de autenticación de este viajero.
     */
    public function auth(): BelongsTo
    {
        return $this->belongsTo(TravelerAuth::class, 'travelers_auth_id');
    }

    /**
     * Reseñas escritas por este viajero.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(HotelReview::class, 'traveler_id');
    }
}
