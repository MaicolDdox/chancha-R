<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $maxHours = (int) config('reservations.max_hours', 8);

        return [
            'zone_id' => ['required', 'integer', 'exists:zones,id'],
            'start_at' => ['required', 'date', 'after:now'],
            'hours' => ['required', 'integer', 'min:1', 'max:'.$maxHours],
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_phone' => ['required', 'string', 'min:7', 'max:30'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }
}
