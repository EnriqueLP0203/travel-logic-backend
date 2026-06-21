<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelTranslation extends Model
{
    protected $table = 'hotels_t';

    public $timestamps = false;

    protected $fillable = [
        'hotel_id',
        'language_code',
        'short_description',
        'description',
        'amenities',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Hotel al que pertenece esta traducción.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }
}
