<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClassificationGroup extends Model
{
    protected $table = 'classification_groups';

    public $timestamps = true;

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

    /**
     * Clasificaciones que pertenecen a este grupo.
     */
    public function classifications(): HasMany
    {
        return $this->hasMany(Classification::class, 'classification_group_id');
    }

    /**
     * Todas las traducciones del nombre del grupo.
     */
    public function translations(): HasMany
    {
        return $this->hasMany(ClassificationGroupTranslation::class, 'classification_group_id');
    }

    /**
     * Traducción del grupo para un idioma específico.
     */
    public function translation(string $languageCode = 'es-MX'): HasOne
    {
        return $this->hasOne(ClassificationGroupTranslation::class, 'classification_group_id')
            ->where('language_code', $languageCode);
    }
}
