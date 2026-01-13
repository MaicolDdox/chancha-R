@php($title = 'Mis reservaciones')

@extends('layouts.client')

@section('content')
    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold text-slate-900">Mis reservaciones</h1>
        <p class="text-sm text-slate-600">Historial y estado de tus reservas.</p>

        <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-4 py-3">Cancha</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Horas</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Factura</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($reservations as $reservation)
                        <tr class="bg-white">
                            <td class="px-4 py-3">
                                <div class="font-semibold text-slate-900">{{ $reservation->zone?->name }}</div>
                                <div class="text-xs text-slate-500">{{ $reservation->zone?->location ?: 'Sin ubicacion' }}</div>
                            </td>
                            <td class="px-4 py-3 text-slate-600">{{ optional($reservation->start_at)->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3 text-slate-600">{{ $reservation->hours }}</td>
                            <td class="px-4 py-3 text-slate-600">${{ number_format($reservation->total, 2) }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $reservation->status === 'confirmada' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                    {{ ucfirst($reservation->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @if ($reservation->invoice)
                                    <a
                                        href="{{ route('invoices.show', $reservation->invoice) }}"
                                        class="text-sm font-semibold text-purple-700 hover:text-purple-600"
                                    >
                                        {{ $reservation->invoice->invoice_number }}
                                    </a>
                                @else
                                    <span class="text-xs text-slate-500">Sin factura</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-sm text-slate-500">
                                Aun no tienes reservaciones registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4">
            {{ $reservations->links() }}
        </div>
    </section>
@endsection
