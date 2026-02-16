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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('influencer_id')->constrained('influencer_profiles')->onDelete('cascade');
            $table->integer('rating'); // 1-5
            $table->integer('communication_rating')->nullable(); // 1-5
            $table->integer('quality_rating')->nullable(); // 1-5
            $table->integer('professionalism_rating')->nullable(); // 1-5
            $table->integer('value_rating')->nullable(); // 1-5
            $table->text('comment')->nullable();
            $table->text('influencer_response')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('order_id');
            $table->index('customer_id');
            $table->index('influencer_id');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
