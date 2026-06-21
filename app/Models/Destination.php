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
}
