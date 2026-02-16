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
        Schema::create('influencer_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_profiles')->onDelete('cascade');
            $table->enum('platform', ['instagram', 'youtube', 'tiktok', 'twitter', 'facebook', 'linkedin', 'twitch', 'pinterest']);
            $table->bigInteger('follower_count')->default(0);
            $table->bigInteger('avg_views')->default(0);
            $table->decimal('engagement_rate', 5, 2)->default(0); // e.g., 5.25%
            $table->bigInteger('reach')->default(0);
            $table->json('audience_demographics')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('influencer_id');
            $table->index('platform');
            $table->index('follower_count');
            $table->index('engagement_rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencer_metrics');
    }
};
