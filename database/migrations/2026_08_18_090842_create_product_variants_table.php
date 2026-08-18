<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->string('size_label');              // "6 inch", "14 inch specimen"
            $table->unsignedTinyInteger('age_years')->nullable();
            $table->string('pot_type')->nullable();     // "glazed ceramic", "training pot"
            $table->unsignedInteger('price_cents');
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->decimal('shipping_weight_lbs', 5, 2)->nullable();
            $table->enum('shipping_profile', ['standard', 'signature_required', 'seasonal_hold'])->default('standard');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
