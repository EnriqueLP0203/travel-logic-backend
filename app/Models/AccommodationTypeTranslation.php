<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationTypeTranslation extends Model
{
    protected $table = 'accommodation_types_t';

    public $timestamps = false;

    protected $fillable = [
        'accommodation_type_id',
        'language_code',
        'name',
    ];

    public function accommodationType(): BelongsTo
    {
        return $this->belongsTo(AccommodationType::class, 'accommodation_type_id');
    }
}
