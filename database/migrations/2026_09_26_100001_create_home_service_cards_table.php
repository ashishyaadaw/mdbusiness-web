<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_service_cards', function (Blueprint $table) {
            $table->id();
            $table->string('eyebrow')->nullable(); // e.g. "Looking for?"
            $table->string('title')->nullable(); // e.g. "Interior Design"
            $table->string('subtitle')->nullable(); // e.g. "Quick Quotes"
            $table->string('image_path')->nullable();
            $table->string('bg_class')->nullable(); // tailwind bg color class, e.g. bg-slate-900
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_service_cards');
    }
};
