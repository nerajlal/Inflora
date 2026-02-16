<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InfluencerProfile;
use App\Models\User;

class InfluencerProfileFactory extends Factory
{
    protected $model = InfluencerProfile::class;

    public function definition(): array
    {
        $isVerified = fake()->boolean(30);

        return [
            'user_id' => User::factory(),
            'bio' => fake()->paragraph(),
            'location' => fake()->city() . ', ' . fake()->country(),
            'is_verified' => $isVerified,
            'verification_status' => $isVerified ? 'approved' : fake()->randomElement(['pending', 'rejected']),
            'profile_image' => null, // Will use placeholder in view if null
            'cover_image' => null,
            'languages' => json_encode(fake()->randomElements(['English', 'Spanish', 'French', 'German'], 2)),
        ];
    }
}
