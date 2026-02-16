<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServicePackage extends Model
{
    protected $fillable = [
        'service_id',
        'package_type',
        'name',
        'description',
        'price',
        'delivery_days',
        'features',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'delivery_days' => 'integer',
        'features' => 'array',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
