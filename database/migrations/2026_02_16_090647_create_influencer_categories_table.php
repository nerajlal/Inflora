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
        Schema::create('influencer_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('influencer_id')->constrained('influencer_profiles')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->boolean('is_primary')->default(false);
            
            // Indexes
            $table->index('influencer_id');
            $table->index('category_id');
            $table->unique(['influencer_id', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencer_categories');
    }
};
