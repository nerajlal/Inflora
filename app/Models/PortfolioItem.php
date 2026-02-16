<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioItem extends Model
{
    protected $fillable = [
        'influencer_id',
        'title',
        'description',
        'media_type',
        'media_url',
        'thumbnail_url',
        'metrics',
    ];

    protected $casts = [
        'metrics' => 'array',
    ];

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_id');
    }
}
