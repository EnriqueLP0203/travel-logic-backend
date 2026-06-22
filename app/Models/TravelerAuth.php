<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;  // <- este es el correcto
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class TravelerAuth extends Authenticatable
{
    use HasApiTokens;

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

    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }

    public function traveler(): HasOne
    {
        return $this->hasOne(Traveler::class, 'travelers_auth_id');
    }
}
