<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('matters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['image', 'text']); // Categorizes the ad
            $table->text('payload'); // Stores the text content OR the image path
            $table->timestamps();
        });

        Schema::create('matter_details', function (Blueprint $table) {
            $table->id();

            // Best Practice: Explicitly define the table name in constrained()
            $table
                ->foreignId('matter_id')
                ->unique() // Enforces One-to-One relationship
                ->constrained('matters') // Assumes the parent table is named 'matters'
                ->onDelete('cascade');
        });

        Schema::create('matter_controllers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matter_id')
                ->unique()
                ->constrained('matters')
                ->onDelete('cascade');

            $table->boolean('is_premium')->default(false);
            $table->enum('status', [
                'active', 'inactive', 'pending', 'hold', 'block', 'rejected',
            ])->default('pending');

            // Use nullable() if you plan to set this via the Model instead of the DB
            $table->timestamp('valid_until')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matter_controllers');
        Schema::dropIfExists('matter_details');
        Schema::dropIfExists('matters');
    }
};
