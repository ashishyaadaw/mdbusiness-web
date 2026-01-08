<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('religions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('castes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('religion_id')->constrained()->onDelete('cascade');
            $table->string('name');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('castes');
        Schema::dropIfExists('religions');
    }
};
