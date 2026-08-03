<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = 'offers';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'link',
        'img_original_name',
        'img_new_name',
        'img_compound_name',
        'img_extension',
        'img_hash_name',
        'img_file_size',
        'active',
        'sort_order',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * URL pública del thumbnail en storage/travel_media/offers.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (empty($this->img_compound_name)) {
            return null;
        }

        $thumbnail = 't_' . $this->img_compound_name;
        $basePath = storage_path('travel_media/offers/');
        $filename = is_file($basePath . $thumbnail)
            ? $thumbnail
            : $this->img_compound_name;

        return route('media.offers', ['filename' => $filename]);
    }

    /**
     * URL pública de la imagen original para banners full-width.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (empty($this->img_compound_name)) {
            return null;
        }

        return route('media.offers', ['filename' => $this->img_compound_name]);
    }
}
