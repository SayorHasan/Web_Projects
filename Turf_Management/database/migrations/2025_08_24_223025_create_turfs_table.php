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
        Schema::create('turfs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('sport_type'); // football, cricket, tennis, etc.
            $table->decimal('price_per_hour', 8, 2);
            $table->string('image_path');
            $table->json('features')->nullable(); // ['floodlights', 'natural_grass', etc.]
            $table->enum('status', ['available', 'maintenance', 'booked'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turfs');
    }
};
