<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SocialAccount;
use App\Models\InfluencerProfile;

class SocialAccountFactory extends Factory
{
    protected $model = SocialAccount::class;

    public function definition(): array
    {
        $platform = fake()->randomElement(['instagram', 'youtube', 'tiktok', 'twitter', 'facebook']);
        $username = fake()->userName();

        return [
            'influencer_id' => InfluencerProfile::factory(),
            'platform' => $platform,
            'username' => $username,
            'profile_url' => "https://{$platform}.com/{$username}",
            'is_verified' => fake()->boolean(20),
        ];
    }
}
