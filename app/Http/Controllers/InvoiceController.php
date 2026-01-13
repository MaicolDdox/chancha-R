<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::query()
            ->with(['reservation.zone'])
            ->whereHas('reservation', function ($query) use ($request) {
                $query->where('user_id', $request->user()->id);
            })
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('invoices.index', [
            'invoices' => $invoices,
        ]);
    }

    public function show(Request $request, Invoice $invoice)
    {
        $invoice->load(['reservation.zone.sport', 'reservation.zone.category', 'reservation.user']);

        if (! $invoice->reservation || $invoice->reservation->user_id !== $request->user()->id) {
            abort(403);
        }

        return view('invoices.show', [
            'invoice' => $invoice,
            'imageUrl' => $invoice->reservation?->zone?->image_url
                ?? asset('welcome/assets/courts/football.jpg'),
        ]);
    }
}
