<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_profiles')->onDelete('cascade');
            $table->enum('platform', ['instagram', 'youtube', 'tiktok', 'twitter', 'facebook', 'linkedin', 'twitch', 'pinterest']);
            $table->string('username');
            $table->string('profile_url');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
            
            // Indexes
            $table->index('influencer_id');
            $table->index('platform');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
};
