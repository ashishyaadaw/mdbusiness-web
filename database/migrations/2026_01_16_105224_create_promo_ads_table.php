<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promo_ads', function (Blueprint $table) {
            $table->id();
            $table->string('ad_id')->unique(); // The ID requested by Flutter
            $table->enum('type', ['slider', 'banner', 'native', 'video']);
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->json('images')->nullable(); // Store array of URLs
            $table->string('action_text')->nullable();
            $table->string('target_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_ads');
    }
};
