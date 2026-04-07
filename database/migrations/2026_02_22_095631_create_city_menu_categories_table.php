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


        // Cities and Menu Category Relationship Table for finding Menu Category With 
        // CityId >> MenuCategoryId 
        // MenuCategoryId >> CityId
        
        Schema::create('city_menu_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('menu_categories_id')->constrained('menu_category')->onDelete('cascade');
            $table->timestamps();
        });

        // Cities and Menus Relationship Table for Menus with Particular 
        // CityId >> MenuId
        // MenuId >> CityId

         Schema::create('city_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_menu_category');
        Schema::dropIfExists('city_menu');
    }
};