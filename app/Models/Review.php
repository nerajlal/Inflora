<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'influencer_id',
        'rating',
        'communication_rating',
        'quality_rating',
        'professionalism_rating',
        'value_rating',
        'comment',
        'influencer_response',
    ];

    protected $casts = [
        'rating' => 'integer',
        'communication_rating' => 'integer',
        'quality_rating' => 'integer',
        'professionalism_rating' => 'integer',
        'value_rating' => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_id');
    }

    public function getAverageDetailedRating(): float
    {
        $ratings = array_filter([
            $this->communication_rating,
            $this->quality_rating,
            $this->professionalism_rating,
            $this->value_rating,
        ]);

        return count($ratings) > 0 ? array_sum($ratings) / count($ratings) : 0;
    }
}
