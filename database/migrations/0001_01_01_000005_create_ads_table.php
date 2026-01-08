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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('title');
            $table->enum('type', ['image', 'text']); // Categorizes the ad
            $table->text('payload'); // Stores the text content OR the image path
            $table->timestamps();
        });

        Schema::create('ad_details', function (Blueprint $table) {
            $table->id();

            // Best Practice: Explicitly define the table name in constrained()
            $table->foreignId('ad_id')
                ->unique() // Enforces One-to-One relationship
                ->constrained('ads') // Assumes the parent table is named 'ads'
                ->onDelete('cascade');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });

        Schema::create('ad_creators', function (Blueprint $table) {
            $table->id();   // Link to the main Ad
            $table->foreignId('ad_id')
                ->unique() // Enforces One-to-One relationship
                ->constrained('ads') // Assumes the parent table is named 'ads'
                ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('contact')->nullable();
            $table->string('alternate_contact')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });

        Schema::create('ad_controllers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ad_id')
                ->unique() // Enforces One-to-One relationship
                ->constrained('ads') // Assumes the parent table is named 'ads'
                ->onDelete('cascade');
            $table->boolean('is_premium')->default(false);
            $table->enum('status', ['active', 'inactive', 'pending', 'hold', 'block', 'rejected'])->default('pending');
            $table->dateTime('valid_until')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_controllers');
        Schema::dropIfExists('ad_creators');
        Schema::dropIfExists('ad_details');
        Schema::dropIfExists('ads');
    }
};
