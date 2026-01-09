<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'zone_id' => Zone::factory(),
            'user_id' => User::factory(),
            'customer_name' => fake()->regexify('[A-Za-z0-9]{120}'),
            'customer_phone' => fake()->regexify('[A-Za-z0-9]{30}'),
            'start_at' => fake()->dateTime(),
            'hours' => fake()->numberBetween(-10000, 10000),
            'end_at' => fake()->dateTime(),
            'hourly_price' => fake()->randomFloat(2, 0, 99999999.99),
            'total' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->randomElement(["pendiente","confirmada","cancelada","finalizada"]),
            'notes' => fake()->text(),
        ];
    }
}
