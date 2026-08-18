<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    public function definition(): array
    {
        $size = fake()->randomElement(['6 inch', '10 inch', '14 inch specimen']);

        return [
            'product_id' => Product::factory(),
            'sku' => strtoupper(fake()->bothify('BNS-####')),
            'size_label' => $size,
            'age_years' => fake()->numberBetween(2, 20),
            'pot_type' => fake()->randomElement(['glazed ceramic', 'unglazed clay', 'training pot']),
            'price_cents' => fake()->numberBetween(3500, 45000),
            'stock_quantity' => fake()->numberBetween(0, 15),
            'shipping_weight_lbs' => fake()->randomFloat(2, 2, 25),
            'shipping_profile' => fake()->randomElement(['standard', 'signature_required', 'seasonal_hold']),
            'is_active' => true,
        ];
    }
}