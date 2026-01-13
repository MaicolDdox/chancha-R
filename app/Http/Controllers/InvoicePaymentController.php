<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessPaymentRequest;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoicePaymentController extends Controller
{
    public function store(ProcessPaymentRequest $request, Invoice $invoice)
    {
        $reservation = $invoice->reservation;
        if (! $reservation || $reservation->user_id !== $request->user()->id) {
            abort(403);
        }

        if ($invoice->status === 'pagada') {
            return redirect()
                ->route('invoices.show', $invoice)
                ->with('payment_success', 'La factura ya esta pagada.');
        }

        $payload = $this->buildPayload($request);

        DB::transaction(function () use ($invoice, $reservation, $payload, $request) {
            $invoice->update([
                'status' => 'pagada',
                'payment_method' => $request->input('payment_method'),
                'paid_at' => now(),
                'payload' => array_merge($invoice->payload ?? [], $payload),
            ]);

            $reservation->update([
                'status' => 'confirmada',
            ]);
        });

        return redirect()
            ->route('invoices.show', $invoice)
            ->with('payment_success', 'Pago realizado correctamente.');
    }

    private function buildPayload(ProcessPaymentRequest $request): array
    {
        $method = $request->input('payment_method');
        $payload = [
            'method' => $method,
        ];

        if ($method === 'tarjeta') {
            $digits = preg_replace('/\\D+/', '', (string) $request->input('card_number'));
            $payload['card_last4'] = $digits ? substr($digits, -4) : null;
            $payload['card_exp'] = $request->input('card_exp');
            $payload['card_name'] = $request->input('card_name');
        }

        if ($method === 'pse') {
            $payload['bank'] = $request->input('pse_bank');
            $payload['document'] = $request->input('pse_document');
        }

        if ($method === 'transferencia') {
            $payload['bank'] = $request->input('transfer_bank');
            $payload['reference'] = $request->input('transfer_reference');
        }

        if ($method === 'efectivo') {
            $payload['cash_notes'] = $request->input('cash_notes');
        }

        return $payload;
    }
}
