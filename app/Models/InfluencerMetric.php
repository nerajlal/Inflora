<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InfluencerMetric extends Model
{
    protected $fillable = [
        'influencer_id',
        'platform',
        'follower_count',
        'avg_views',
        'engagement_rate',
        'reach',
        'audience_demographics',
    ];

    protected $casts = [
        'follower_count' => 'integer',
        'avg_views' => 'integer',
        'engagement_rate' => 'decimal:2',
        'reach' => 'integer',
        'audience_demographics' => 'array',
    ];

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_id');
    }
}
