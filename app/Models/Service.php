<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    protected $fillable = [
        'influencer_id',
        'title',
        'description',
        'service_type',
        'base_price',
        'delivery_days',
        'revisions_included',
        'requirements',
        'is_active',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'delivery_days' => 'integer',
        'revisions_included' => 'integer',
        'is_active' => 'boolean',
    ];

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_id');
    }

    public function packages(): HasMany
    {
        return $this->hasMany(ServicePackage::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
