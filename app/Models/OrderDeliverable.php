<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDeliverable extends Model
{
    protected $fillable = [
        'order_id',
        'file_path',
        'file_type',
        'description',
        'delivered_at',
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
