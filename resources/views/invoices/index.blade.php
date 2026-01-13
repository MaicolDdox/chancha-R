@php($title = 'Recibos y facturas')

@extends('layouts.client')

@section('content')
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold text-slate-900">Recibos y facturas</h1>
        <p class="text-sm text-slate-600">Consulta tus pagos y estados de factura.</p>

        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Factura</th>
                        <th class="px-4 py-3">Cancha</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Pago</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($invoices as $invoice)
                        <tr class="bg-white">
                            <td class="px-4 py-3 font-semibold text-slate-900">{{ $invoice->invoice_number }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $invoice->reservation?->zone?->name }}</td>
                            <td class="px-4 py-3 text-slate-600">${{ number_format($invoice->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $invoice->status === 'pagada' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <a
                                    href="{{ route('invoices.show', $invoice) }}"
                                    class="rounded-full bg-emerald-600 px-3 py-1 text-xs font-semibold text-white hover:bg-emerald-700"
                                >
                                    {{ $invoice->status === 'pendiente' ? 'Pagar' : 'Ver' }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-sm text-slate-500">
                                Aun no tienes facturas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $invoices->links() }}
        </div>
    </section>
@endsection
