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
            $table->id();
            $table->boolean('city')->default(null);
            $table->boolean('menu')->default(null);
            $table->boolean('menu_categories')->default(null);
            $table->boolean('city_menu')->default(null);
            $table->boolean('city_menu_matter')->default(null);
            $table->boolean('matter')->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flags
        ');
    }
};
