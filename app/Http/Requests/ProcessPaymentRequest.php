<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_method' => ['required', 'in:efectivo,tarjeta,transferencia,pse'],
            'card_number' => ['required_if:payment_method,tarjeta', 'digits_between:13,19'],
            'card_exp' => ['required_if:payment_method,tarjeta', 'regex:/^(0[1-9]|1[0-2])\\/\\d{2}$/'],
            'card_cvc' => ['required_if:payment_method,tarjeta', 'digits_between:3,4'],
            'card_name' => ['nullable', 'string', 'max:120'],
            'pse_bank' => ['required_if:payment_method,pse', 'string', 'max:120'],
            'pse_document' => ['required_if:payment_method,pse', 'string', 'max:30'],
            'transfer_bank' => ['required_if:payment_method,transferencia', 'string', 'max:120'],
            'transfer_reference' => ['required_if:payment_method,transferencia', 'string', 'max:60'],
            'cash_notes' => ['nullable', 'string', 'max:200'],
        ];
    }
}
