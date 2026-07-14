<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    protected $table = 'destinations';

    public $timestamps = true;

    protected $fillable = [
        'city',
        'state',
        'country',
        'img_original_name',
        'img_new_name',
        'img_compound_name',
        'img_extension',
        'img_hash_name',
        'img_file_size',
        'slug',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Hoteles que pertenecen a este destino.
     */
    public function hotels(): HasMany
    {
        return $this->hasMany(Hotel::class, 'destination_id');
    }

    /**
     * URL pública del thumbnail en storage/travel_media/destinations.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (empty($this->img_compound_name)) {
            return null;
        }

        $thumbnail = 't_' . $this->img_compound_name;
        $basePath = storage_path('travel_media/destinations/');
        $filename = is_file($basePath . $thumbnail)
            ? $thumbnail
            : $this->img_compound_name;

        return route('media.destinations', ['filename' => $filename]);
    }
}
