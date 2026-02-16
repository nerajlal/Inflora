<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialAccount extends Model
{
    protected $fillable = [
        'influencer_id',
        'platform',
        'username',
        'profile_url',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_id');
    }
}
