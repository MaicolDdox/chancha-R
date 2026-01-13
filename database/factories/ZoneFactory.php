<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Sport;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'sport_id' => Sport::factory(),
            'name' => fake()->name(),
            'location' => fake()->city(),
            'description' => fake()->text(),
            'price_per_hour' => fake()->randomFloat(2, 0, 99999999.99),
            'image' => fake()->regexify('[A-Za-z0-9]{255}'),
            'status' => fake()->randomElement(["disponible","mantenimiento","ocupada"]),
        ];
    }
}
