<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TravelerAuth extends Model
{
    protected $table = 'travelers_auth';

    public $timestamps = true;

    protected $fillable = [
        'email',
        'auth_key',
        'password_hash',
        'security_token',
        'registration_ip',
        'confirmed_at',
        'blocked_at',
        'last_login_at',
        'last_login_ip',
        'password_changed_at',
    ];

    protected $hidden = [
        'password_hash',
        'auth_key',
        'security_token',
    ];

    /**
     * Perfil público asociado a esta cuenta.
     */
    public function traveler(): HasOne
    {
        return $this->hasOne(Traveler::class, 'travelers_auth_id');
    }
}
