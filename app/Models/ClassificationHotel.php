<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo explícito de la tabla pivote `classifications_hotels`.
 */
class ClassificationHotel extends Model
{
    protected $table = 'classifications_hotels';

    public $timestamps = false;

    protected $fillable = [
        'classification_id',
        'hotel_id',
    ];

    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'classification_id');
    }

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
