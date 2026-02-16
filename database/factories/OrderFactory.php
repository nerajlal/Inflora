<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;
use App\Models\InfluencerProfile;
use App\Models\Service;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $amount = fake()->numberBetween(100, 5000);
        $status = fake()->randomElement(['pending', 'in_progress', 'completed', 'cancelled']);

        return [
            'order_number' => Str::upper(Str::random(10)),
            'customer_id' => User::factory(),
            'influencer_id' => InfluencerProfile::factory(),
            'service_id' => Service::factory(),
            'package_id' => null,
            'status' => $status,
            'total_amount' => $amount,
            'platform_fee' => $amount * 0.1,
            'influencer_earnings' => $amount * 0.9,
            'brief' => fake()->paragraph(),
            'requirements' => json_encode(['specs' => fake()->sentence()]),
            'delivery_date' => now()->addDays(fake()->numberBetween(3, 10)),
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
