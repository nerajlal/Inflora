<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\InfluencerProfile;
use App\Models\Service;
use App\Models\SocialAccount;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Categories
        $this->call(CategorySeeder::class);
        $categories = Category::all();

        $this->command->info('Categories seeded.');

        // 2. Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // 3. Create Influencers
        $this->command->info('Seeding influencers...');
        
        // Specific Demo Influencer
        $demoInfluencer = User::create([
            'name' => 'Sarah Creator',
            'email' => 'influencer@example.com',
            'password' => Hash::make('password'),
            'role' => 'influencer',
            'email_verified_at' => now(),
        ]);
        
        $this->createInfluencerData($demoInfluencer, $categories);

        // Random Influencers
        $influencers = User::factory(20)->create(['role' => 'influencer']);
        
        foreach ($influencers as $influencer) {
            $this->createInfluencerData($influencer, $categories);
        }

        // 4. Create Customers
        $this->command->info('Seeding customers...');
        
        // Specific Demo Customer
        $demoCustomer = User::create([
            'name' => 'John Brand',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);

        $customers = User::factory(10)->create(['role' => 'customer']);
        $allCustomers = $customers->push($demoCustomer);

        // 5. Create Orders & Reviews
        $this->command->info('Seeding orders and reviews...');
        
        $allServices = Service::all();

        if ($allServices->count() > 0 && $allCustomers->count() > 0) {
            // Create 50 random orders
            for ($i = 0; $i < 50; $i++) {
                $customer = $allCustomers->random();
                $service = $allServices->random();
                $influencerProfile = $service->influencer; // Get the profile relation

                // Create Order
                $order = Order::factory()->create([
                    'customer_id' => $customer->id,
                    'influencer_id' => $influencerProfile->id,
                    'service_id' => $service->id,
                ]);

                // If completed, maybe add a review
                if ($order->status === 'completed' && fake()->boolean(70)) {
                    Review::factory()->create([
                        'order_id' => $order->id,
                        'customer_id' => $customer->id,
                        'influencer_id' => $influencerProfile->id,
                    ]);
                }
            }
        }
        
        $this->command->info('Database seeded successfully!');
    }

    /**
     * Helper to create profile, services, and accounts for an influencer user.
     */
    private function createInfluencerData($user, $categories)
    {
        // Profile
        $profile = InfluencerProfile::factory()->create([
            'user_id' => $user->id,
        ]);

        // Attach Categories
        if ($categories->count() > 0) {
            $profile->categories()->attach($categories->random(rand(1, 3)));
        }

        // Services
        Service::factory(rand(2, 4))->create([
            'influencer_id' => $profile->id,
        ]);

        // Social Accounts
        SocialAccount::factory(rand(1, 3))->create([
            'influencer_id' => $profile->id,
        ]);
    }
}
