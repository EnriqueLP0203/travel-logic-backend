<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelGroup extends Model
{
    protected $table = 'hotel_groups';

    public $timestamps = false;

    protected $fillable = [
        'order',
        'img_original_name',
        'img_new_name',
        'img_compound_name',
        'img_extension',
        'img_hash_name',
        'img_file_size',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function translations(): HasMany
    {
        return $this->hasMany(HotelGroupTranslation::class, 'hotel_group_id');
    }

    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(
            Hotel::class,
            'hotels_hotel_groups',
            'hotel_group_id',
            'hotel_id'
        );
    }
}
