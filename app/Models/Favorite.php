<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
        'influencer_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_id');
    }
}
