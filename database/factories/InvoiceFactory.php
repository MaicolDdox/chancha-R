<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'reservation_id' => Reservation::factory(),
            'invoice_number' => fake()->regexify('[A-Za-z0-9]{40}'),
            'subtotal' => fake()->randomFloat(2, 0, 99999999.99),
            'taxes' => fake()->randomFloat(2, 0, 99999999.99),
            'total' => fake()->randomFloat(2, 0, 99999999.99),
            'status' => fake()->randomElement(["pendiente","pagada","anulada"]),
            'payment_method' => fake()->randomElement(["efectivo","tarjeta","transferencia","pse"]),
            'paid_at' => fake()->dateTime(),
            'pdf_path' => fake()->regexify('[A-Za-z0-9]{255}'),
            'payload' => '{}',
        ];
    }
}
