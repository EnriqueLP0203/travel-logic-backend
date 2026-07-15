<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelGroupTranslation extends Model
{
    protected $table = 'hotel_groups_t';

    public $timestamps = false;

    protected $fillable = [
        'hotel_group_id',
        'language_code',
        'name',
    ];

    public function hotelGroup(): BelongsTo
    {
        return $this->belongsTo(HotelGroup::class, 'hotel_group_id');
    }
}
