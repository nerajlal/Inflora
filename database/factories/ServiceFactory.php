<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Service;
use App\Models\InfluencerProfile;

class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        return [
            'influencer_id' => InfluencerProfile::factory(),
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'service_type' => fake()->randomElement(['instagram_post', 'instagram_story', 'tiktok_video', 'youtube_video', 'blog_post']),
            'base_price' => fake()->numberBetween(50, 5000),
            'delivery_days' => fake()->numberBetween(1, 14),
            'revisions_included' => fake()->numberBetween(0, 3),
            'requirements' => fake()->paragraph(),
            'is_active' => true,
        ];
    }
}
