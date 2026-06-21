<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Agency extends Model
{
    protected $table = 'agencies';

    public $timestamps = true;

    protected $fillable = [
        'comercial_name',
        'business_name',
        'logo_path',
        'website',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'bio',
        'active',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];
    
    protected $casts = [
        'active' => 'boolean',
    ];


    public function hotels(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'agencies_hotels', 'agency_id', 'hotel_id');
    }
}

