<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
        'symbol',
        'default_lang',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'default_lang' => 'boolean',
        'active' => 'boolean',
    ];
}
