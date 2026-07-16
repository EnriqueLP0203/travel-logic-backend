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
        'img_original_name',
        'img_new_name',
        'img_compound_name',
        'img_extension',
        'img_hash_name',
        'img_file_size',
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

    /**
     * URL pública del thumbnail en storage/travel_media/hotel_groups.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (empty($this->img_compound_name)) {
            return null;
        }

        $thumbnail = 't_' . $this->img_compound_name;
        $basePath = storage_path('travel_media/hotel_groups/');
        $filename = is_file($basePath . $thumbnail)
            ? $thumbnail
            : $this->img_compound_name;

        return route('media.hotel-groups', ['filename' => $filename]);
    }
}
