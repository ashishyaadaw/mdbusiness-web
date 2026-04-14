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
        // Here flags table is created to store the boolean value for city, menu and matter.
        // This will help us to easily manage the active/inactive status of city, menu and matter without deleting the records from the database.
        Schema::create('flags', function (Blueprint $table) {
            $table->id(); /** This is treated as id for all city,menu,menu_category,.... */
            $table->boolean('city')->default(0);
            $table->boolean('menus')->default(0);
            $table->boolean('menu_category')->default(0);
            $table->boolean('city_menu')->default(0);
            $table->boolean('city_menu_matter')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flags');
    }
};