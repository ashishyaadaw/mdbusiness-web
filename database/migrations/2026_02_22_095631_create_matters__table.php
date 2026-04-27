<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Core Ad Content
        Schema::create('matters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['image', 'text']);
            $table->text('payload'); 
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Contact & Metadata
        Schema::create('matter_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matter_id')->unique()->constrained('matters')->onDelete('cascade');
            $table->string('name')->nullable(); // From Flutter _nameController
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable(); // From Flutter _whatsappController
            $table->string('alternate_contact')->nullable();
            $table->string('website')->nullable();
            $table->string('social_media')->nullable();
            $table->string('gstin')->nullable(); // Added for billing
            $table->timestamps();
        });

        // NEW: Financial & Pricing Data
        Schema::create('matter_pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matter_id')->unique()->constrained('matters')->onDelete('cascade');
            
            $table->integer('duration_days'); // e.g., 7, 30, 365
            $table->decimal('base_amount', 12, 2); // Amount after discount
            $table->decimal('discount_amount', 12, 2)->default(0.00); 
            $table->decimal('processing_fee', 10, 2)->default(25.00);
            $table->decimal('gst_amount', 12, 2);
            $table->decimal('total_amount', 12, 2);
            
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });

        // Status & Visibility Control
        Schema::create('matter_controller', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matter_id')->unique()->constrained('matters')->onDelete('cascade');
            $table->boolean('is_premium')->default(false);
            $table->enum('status', [
                'active', 'inactive', 'pending', 'hold', 'block', 'rejected',
            ])->default('pending');

            $table->timestamp('valid_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matter_controller');
        Schema::dropIfExists('matter_pricing');
        Schema::dropIfExists('matter_details');
        Schema::dropIfExists('matters');
    }
};