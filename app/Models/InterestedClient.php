<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InterestedClient extends Model
{
    protected $fillable = [
        'agency_name',
        'agent_name',
        'email',
        'phone',
        'country',
        'city',
        'service_type',
        'is_attended',
    ];


    protected $casts = [
        'is_attended' => 'boolean',
    ];

    public function scopePending(Builder $query): Builder
    {
        return $query->where('is_attended', false);
    }

    public function scopeAttended(Builder $query): Builder
    {
        return $query->where('is_attended', true);
    }
}
