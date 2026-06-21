<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Classification extends Model
{
    protected $table = 'classifications';

    public $timestamps = true;

    protected $fillable = [
        'classification_group_id',
        'order',
        'icon_class',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Grupo al que pertenece esta clasificación.
     */
    public function classificationGroup(): BelongsTo
    {
        return $this->belongsTo(ClassificationGroup::class, 'classification_group_id');
    }

    /**
     * Todas las traducciones del nombre de la clasificación.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(ClassificationTranslation::class, 'classification_id');
    }

    /**
     * Traducción de la clasificación para un idioma específico.
     */
    public function translation(string $languageCode = 'es-MX'): HasOne
    {
        return $this->hasOne(ClassificationTranslation::class, 'classification_id')
            ->where('language_code', $languageCode);
    }

    /**
     * Hoteles que tienen esta clasificación.
     */
    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(
            Hotel::class,
            'classifications_hotels',
            'classification_id',
            'hotel_id'
        );
    }
}
