<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InterestedClient extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
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
