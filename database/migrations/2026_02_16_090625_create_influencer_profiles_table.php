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
        Schema::create('influencer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('bio')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('location')->nullable();
            $table->json('languages')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->enum('verification_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('is_verified');
            $table->index('verification_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('influencer_profiles');
    }
};
