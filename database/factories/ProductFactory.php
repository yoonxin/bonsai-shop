<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Species;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement(['Windswept', 'Cascade', 'Formal Upright', 'Literati', 'Twin Trunk']) . ' Bonsai';

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->randomNumber(5),
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'species_id' => Species::inRandomOrder()->first()?->id ?? Species::factory(),
            'short_description' => fake()->sentence(),
            'description' => fake()->paragraphs(3, true),
            'is_gift_eligible' => true,
            'is_one_of_a_kind' => fake()->boolean(15),
            'status' => 'active',
            'published_at' => now(),
        ];
    }
}