<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccommodationType extends Model
{
    protected $table = 'accommodation_types';

    public $timestamps = false;

    protected $fillable = [
        'order',
        'icon_class',
        'active',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(AccommodationTypeTranslation::class, 'accommodation_type_id');
    }

    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(
            Hotel::class,
            'hotels_accommodation_types',
            'accommodation_type_id',
            'hotel_id'
        );
    }
}
