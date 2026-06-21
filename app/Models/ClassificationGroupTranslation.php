<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassificationGroupTranslation extends Model
{
    protected $table = 'classification_groups_t';

    public $timestamps = false;

    protected $fillable = [
        'classification_group_id',
        'language_code',
        'classification_group_name',
    ];

    public function classificationGroup(): BelongsTo
    {
        return $this->belongsTo(ClassificationGroup::class, 'classification_group_id');
    }
}
