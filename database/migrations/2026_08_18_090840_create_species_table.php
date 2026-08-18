<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('common_name');       // "Chinese Elm"
            $table->string('botanical_name');    // "Ulmus parvifolia"
            $table->string('slug')->unique();
            $table->enum('light_requirement', ['full_sun', 'partial_shade', 'indoor_bright', 'indoor_low'])->default('partial_shade');
            $table->enum('indoor_outdoor', ['indoor', 'outdoor', 'both'])->default('outdoor');
            $table->string('watering_frequency')->nullable(); // "when top inch is dry"
            $table->string('hardiness_zone')->nullable();     // "5-9"
            $table->boolean('is_beginner_friendly')->default(false);
            $table->text('care_summary')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
