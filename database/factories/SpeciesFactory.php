<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SpeciesFactory extends Factory
{
    public function definition(): array
    {
        $pairs = [
            ['Chinese Elm', 'Ulmus parvifolia'],
            ['Juniper Procumbens', 'Juniperus procumbens'],
            ['Ficus', 'Ficus microcarpa'],
            ['Japanese Maple', 'Acer palmatum'],
            ['Jade', 'Crassula ovata'],
        ];
        [$common, $botanical] = fake()->randomElement($pairs);

        return [
            'common_name' => $common,
            'botanical_name' => $botanical,
            'slug' => Str::slug($common) . '-' . fake()->unique()->randomNumber(4),
            'light_requirement' => fake()->randomElement(['full_sun', 'partial_shade', 'indoor_bright', 'indoor_low']),
            'indoor_outdoor' => fake()->randomElement(['indoor', 'outdoor', 'both']),
            'watering_frequency' => 'when top inch of soil is dry',
            'hardiness_zone' => fake()->randomElement(['5-9', '6-10', '4-8']),
            'is_beginner_friendly' => fake()->boolean(60),
            'care_summary' => fake()->paragraph(),
        ];
    }
}