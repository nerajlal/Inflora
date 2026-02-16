<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fashion & Beauty',
                'slug' => 'fashion-beauty',
                'description' => 'Fashion, beauty, makeup, and style influencers',
                'icon' => '👗',
            ],
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Tech reviews, gadgets, and software',
                'icon' => '💻',
            ],
            [
                'name' => 'Food & Cooking',
                'slug' => 'food-cooking',
                'description' => 'Food bloggers, chefs, and cooking enthusiasts',
                'icon' => '🍳',
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Travel bloggers and adventure seekers',
                'icon' => '✈️',
            ],
            [
                'name' => 'Fitness & Health',
                'slug' => 'fitness-health',
                'description' => 'Fitness trainers, health coaches, and wellness experts',
                'icon' => '💪',
            ],
            [
                'name' => 'Gaming',
                'slug' => 'gaming',
                'description' => 'Gaming streamers and esports',
                'icon' => '🎮',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'General lifestyle and daily vlogs',
                'icon' => '🌟',
            ],
            [
                'name' => 'Business & Finance',
                'slug' => 'business-finance',
                'description' => 'Business tips, finance, and entrepreneurship',
                'icon' => '💼',
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Comedy, music, and general entertainment',
                'icon' => '🎬',
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Educational content and tutorials',
                'icon' => '📚',
            ],
            [
                'name' => 'Parenting',
                'slug' => 'parenting',
                'description' => 'Parenting tips and family content',
                'icon' => '👶',
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'Sports content and athletes',
                'icon' => '⚽',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
