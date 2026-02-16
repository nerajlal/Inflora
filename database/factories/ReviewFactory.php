<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;
use App\Models\Order;
use App\Models\User;
use App\Models\InfluencerProfile;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'customer_id' => User::factory(),
            'influencer_id' => InfluencerProfile::factory(),
            'rating' => fake()->numberBetween(3, 5),
            'communication_rating' => fake()->numberBetween(3, 5),
            'quality_rating' => fake()->numberBetween(3, 5),
            'professionalism_rating' => fake()->numberBetween(3, 5),
            'value_rating' => fake()->numberBetween(3, 5),
            'comment' => fake()->sentence(),
            'influencer_response' => fake()->boolean(20) ? fake()->sentence() : null,
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
