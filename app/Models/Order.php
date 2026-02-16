<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_REVISION_REQUESTED = 'revision_requested';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_DISPUTED = 'disputed';

    protected $fillable = [
        'order_number',
        'customer_id',
        'influencer_id',
        'service_id',
        'package_id',
        'status',
        'total_amount',
        'platform_fee',
        'influencer_earnings',
        'brief',
        'requirements',
        'delivery_date',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'influencer_earnings' => 'decimal:2',
        'requirements' => 'array',
        'delivery_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($order) {
            if (!$order->order_number) {
                $order->order_number = 'ORD-' . strtoupper(uniqid());
            }
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function influencer(): BelongsTo
    {
        return $this->belongsTo(InfluencerProfile::class, 'influencer_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(ServicePackage::class);
    }

    public function deliverables(): HasMany
    {
        return $this->hasMany(OrderDeliverable::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    // Helper methods
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function canBeReviewed(): bool
    {
        return $this->status === self::STATUS_COMPLETED && !$this->review()->exists();
    }
}
