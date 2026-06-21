<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassificationTranslation extends Model
{
    protected $table = 'classifications_t';

    public $timestamps = false;

    protected $fillable = [
        'classification_id',
        'language_code',
        'classification_name',
    ];

    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'classification_id');
    }
}
