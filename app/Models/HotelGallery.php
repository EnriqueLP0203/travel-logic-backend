<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelGallery extends Model
{
    protected $table = 'hotel_gallery';

    public $timestamps = true;

    protected $fillable = [
        'hotel_id',
        'original_name',
        'new_name',
        'compound_name',
        'mime_type',
        'extension',
        'hash_name',
        'file_size',
        'is_principal',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_principal' => 'boolean',
        'active' => 'boolean',
    ];

    /**
     * Hotel al que pertenece esta imagen.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
