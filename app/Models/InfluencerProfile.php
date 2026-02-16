<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InfluencerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'profile_image',
        'cover_image',
        'location',
        'languages',
        'is_verified',
        'verification_status',
    ];

    protected $casts = [
        'languages' => 'array',
        'is_verified' => 'boolean',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function socialAccounts(): HasMany
    {
        return $this->hasMany(SocialAccount::class, 'influencer_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'influencer_categories', 'influencer_id', 'category_id')
            ->withPivot('is_primary');
    }

    public function metrics(): HasMany
    {
        return $this->hasMany(InfluencerMetric::class, 'influencer_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'influencer_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'influencer_id');
    }

    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class, 'influencer_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'influencer_id');
    }

    public function favoritedBy(): HasMany
    {
        return $this->hasMany(Favorite::class, 'influencer_id');
    }

    // Helper methods
    public function getAverageRating(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function getTotalReviews(): int
    {
        return $this->reviews()->count();
    }

    public function isVerified(): bool
    {
        return $this->is_verified && $this->verification_status === 'approved';
    }
}
