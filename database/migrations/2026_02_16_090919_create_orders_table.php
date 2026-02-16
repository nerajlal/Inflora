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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('influencer_id')->constrained('influencer_profiles')->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->nullable()->constrained('service_packages')->onDelete('set null');
            $table->enum('status', [
                'pending',
                'accepted',
                'in_progress',
                'delivered',
                'revision_requested',
                'completed',
                'cancelled',
                'disputed'
            ])->default('pending');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('platform_fee', 10, 2);
            $table->decimal('influencer_earnings', 10, 2);
            $table->text('brief')->nullable();
            $table->json('requirements')->nullable();
            $table->date('delivery_date')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('order_number');
            $table->index('customer_id');
            $table->index('influencer_id');
            $table->index('service_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
