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
        Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_profiles')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('media_type', ['image', 'video', 'link']);
            $table->string('media_url');
            $table->string('thumbnail_url')->nullable();
            $table->json('metrics')->nullable(); // views, likes, engagement, etc.
            $table->timestamps();
            
            // Indexes
            $table->index('influencer_id');
            $table->index('media_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_items');
    }
};
