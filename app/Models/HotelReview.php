<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelReview extends Model
{
    protected $table = 'hotel_reviews';

    public $timestamps = true;

    protected $fillable = [
        'hotel_id',
        'traveler_id',
        'review_text',
        'rating_overall',
        'rating_cleanliness',
        'rating_service',
        'rating_location',
        'rating_facilities',
        'rating_value',
        'status',
        'moderated_by',
        'moderated_at',
        'admin_response',
        'admin_response_date',
        'admin_response_by',
        'active',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'rating_overall' => 'decimal:1',
        'admin_response_date' => 'datetime',
        'active' => 'boolean',
    ];

    /**
     * Estados posibles de moderación de una reseña.
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_FLAGGED = 'flagged';

    /**
     * Hotel reseñado.
     */
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    /**
     * Viajero que escribió la reseña.
     */
    public function traveler(): BelongsTo
    {
        return $this->belongsTo(Traveler::class, 'traveler_id');
    }
}
