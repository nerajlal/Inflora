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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_profiles')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('service_type', [
                'instagram_post', 
                'instagram_story', 
                'instagram_reel',
                'youtube_video',
                'youtube_shorts',
                'tiktok_video',
                'twitter_post',
                'blog_post',
                'product_review',
                'brand_ambassador',
                'event_appearance',
                'custom'
            ]);
            $table->decimal('base_price', 10, 2);
            $table->integer('delivery_days')->default(7);
            $table->integer('revisions_included')->default(1);
            $table->text('requirements')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Indexes
            $table->index('influencer_id');
            $table->index('service_type');
            $table->index('is_active');
            $table->index('base_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
