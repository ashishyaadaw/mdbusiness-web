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
        // For the Different Types of Menu Category
        Schema::create('menu_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->nullable();
            $table->string('desc')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // For the Menus Table
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')->constrained('menu_category')->onDelete('cascade');
            $table->string('title');
            $table->string('icon')->nullable();
            $table->string('desc')->nullable();
            $table->integer('sort_order')->default(0);
            $table->enum('type', ['ad', 'actual'])->default('actual');
            $table->timestamps();
        });
    }
  
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_category');
        Schema::dropIfExists('menus');
    }
};