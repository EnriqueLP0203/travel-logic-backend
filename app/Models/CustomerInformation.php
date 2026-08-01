<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomerInformation extends Model
{
    protected $table = 'customer_information';

    public $timestamps = true;

    protected $fillable = [
        'username',
        'agency_name',
        'legal_name',
        'logo_url',
        'password',
        'contact_person',
        'email',
        'country',
        'state',
        'city',
        'phone',
        'mobile',
        'billing_manager',
        'billing_email',
        'billing_address',
        'billing_country',
        'billing_state',
        'billing_city',
        'billing_zip_code',
        'billing_phone',
        'billing_phone_2',
        'billing_mobile',
        'billing_tax_id',
        'billing_same_as_contact',
        'is_reviewed',
        'is_accepted',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'billing_same_as_contact' => 'boolean',
        'is_reviewed' => 'boolean',
        'is_accepted' => 'boolean',
        'active' => 'boolean',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
    ];

    public function scopePendingReview(Builder $query): Builder
    {
        return $query->where('is_reviewed', false);
    }

    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('is_reviewed', true)->where('is_accepted', true);
    }

    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('is_reviewed', true)->where('is_accepted', false);
    }

    public function getStatusLabelAttribute(): string
    {
        if (! $this->is_reviewed) {
            return 'Pendiente de revisión';
        }

        if ($this->is_accepted === true) {
            return 'Aceptado';
        }

        if ($this->is_accepted === false) {
            return 'Rechazado';
        }

        return 'Revisado';
    }
}
