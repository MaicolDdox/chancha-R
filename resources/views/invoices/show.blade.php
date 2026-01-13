@php($title = 'Pago de factura')

@extends('layouts.client')

@section('content')
    <div class="space-y-6">
        @if (session('payment_success'))
            <div
                x-data="{ show: true }"
                x-init="setTimeout(() => { show = false }, 3200)"
                x-show="show"
                x-cloak
                class="fixed right-6 top-24 z-50 w-80 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 shadow-lg"
            >
                <div class="flex items-start gap-3">
                    <span class="mt-0.5 inline-flex h-6 w-6 items-center justify-center rounded-full bg-emerald-600 text-white">
                        &#10003;
                    </span>
                    <div>
                        <p class="font-semibold">Pago completado</p>
                        <p class="text-emerald-700">{{ session('payment_success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('reservation_success'))
            <div class="rounded-2xl border border-purple-200 bg-purple-50 px-4 py-3 text-sm text-purple-800">
                {{ session('reservation_success') }}
            </div>
        @endif

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Pago de factura</h1>
                    <p class="text-sm text-slate-600">Completa el pago para confirmar la reserva.</p>
                </div>
                <a href="{{ route('invoices.index') }}" class="text-sm font-semibold text-purple-700 hover:text-purple-600">
                    Ver todas mis facturas
                </a>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-[1.2fr_1fr]">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="overflow-hidden rounded-2xl border border-slate-200">
                    <img src="{{ $imageUrl }}" alt="{{ $invoice->reservation?->zone?->name }}" class="h-56 w-full object-cover">
                    <div class="p-4">
                        <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                            <span class="rounded-full bg-slate-100 px-2 py-1">{{ $invoice->reservation?->zone?->sport?->name ?? 'Deporte' }}</span>
                            <span class="rounded-full bg-slate-100 px-2 py-1">{{ $invoice->reservation?->zone?->category?->name ?? 'Categoria' }}</span>
                            <span class="rounded-full bg-slate-100 px-2 py-1">{{ $invoice->reservation?->zone?->location ?: 'Sin ubicacion' }}</span>
                        </div>
                        <h2 class="mt-3 text-lg font-semibold text-slate-900">{{ $invoice->reservation?->zone?->name }}</h2>
                        <p class="mt-2 text-sm text-slate-600">{{ $invoice->reservation?->zone?->description ?: 'Sin descripcion registrada.' }}</p>
                    </div>
                </div>

                <div class="mt-4 grid gap-3 text-sm text-slate-600">
                    <div class="flex items-center justify-between">
                        <span>Factura</span>
                        <span class="font-semibold text-slate-900">{{ $invoice->invoice_number }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Fecha reserva</span>
                        <span>{{ optional($invoice->reservation?->start_at)->format('Y-m-d H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Horas</span>
                        <span>{{ $invoice->reservation?->hours }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>Estado</span>
                        <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $invoice->status === 'pagada' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-base font-semibold text-slate-900">
                        <span>Total</span>
                        <span>${{ number_format($invoice->total, 2) }}</span>
                    </div>
                    @if ($invoice->payment_method)
                        <div class="flex items-center justify-between">
                            <span>Metodo de pago</span>
                            <span>{{ ucfirst($invoice->payment_method) }}</span>
                        </div>
                    @endif
                    @if ($invoice->paid_at)
                        <div class="flex items-center justify-between">
                            <span>Pagado</span>
                            <span>{{ $invoice->paid_at->format('Y-m-d H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-xl font-semibold text-slate-900">Metodo de pago</h3>
                <p class="text-sm text-slate-600">Simulamos el pago para completar la reserva.</p>

                @if ($invoice->status === 'pendiente')
                    <form
                        method="POST"
                        action="{{ route('invoices.pay', $invoice) }}"
                        class="mt-6 space-y-4"
                        x-data="{ method: @json(old('payment_method', 'tarjeta')), loading: false }"
                        x-on:submit="loading = true"
                    >
                        @csrf

                        <div class="space-y-2">
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Metodo de pago</label>
                            <select
                                name="payment_method"
                                x-model="method"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                            >
                                <option value="tarjeta">Tarjeta</option>
                                <option value="pse">PSE</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="transferencia">Transferencia</option>
                            </select>
                            @error('payment_method')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-3" x-show="method === 'tarjeta'" x-cloak>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Numero de tarjeta</label>
                                <input
                                    type="text"
                                    name="card_number"
                                    value="{{ old('card_number') }}"
                                    placeholder="4111111111111111"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                >
                                @error('card_number')
                                    <p class="text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="grid gap-4 md:grid-cols-2">
                                <div class="space-y-2">
                                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Expiracion (MM/AA)</label>
                                    <input
                                        type="text"
                                        name="card_exp"
                                        value="{{ old('card_exp') }}"
                                        placeholder="08/29"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                    >
                                    @error('card_exp')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">CVC</label>
                                    <input
                                        type="text"
                                        name="card_cvc"
                                        value="{{ old('card_cvc') }}"
                                        placeholder="123"
                                        class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                    >
                                    @error('card_cvc')
                                        <p class="text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nombre en tarjeta</label>
                                <input
                                    type="text"
                                    name="card_name"
                                    value="{{ old('card_name') }}"
                                    placeholder="Nombre completo"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                >
                            </div>
                        </div>

                        <div class="space-y-3" x-show="method === 'pse'" x-cloak>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Banco</label>
                                <input
                                    type="text"
                                    name="pse_bank"
                                    value="{{ old('pse_bank') }}"
                                    placeholder="Banco Ejemplo"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                >
                                @error('pse_bank')
                                    <p class="text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Documento</label>
                                <input
                                    type="text"
                                    name="pse_document"
                                    value="{{ old('pse_document') }}"
                                    placeholder="Documento"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                >
                                @error('pse_document')
                                    <p class="text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-3" x-show="method === 'transferencia'" x-cloak>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Banco</label>
                                <input
                                    type="text"
                                    name="transfer_bank"
                                    value="{{ old('transfer_bank') }}"
                                    placeholder="Banco Ejemplo"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                >
                                @error('transfer_bank')
                                    <p class="text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Referencia</label>
                                <input
                                    type="text"
                                    name="transfer_reference"
                                    value="{{ old('transfer_reference') }}"
                                    placeholder="REF-12345"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                >
                                @error('transfer_reference')
                                    <p class="text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="space-y-3" x-show="method === 'efectivo'" x-cloak>
                            <div class="space-y-2">
                                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Notas de pago</label>
                                <textarea
                                    name="cash_notes"
                                    rows="2"
                                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                                >{{ old('cash_notes') }}</textarea>
                            </div>
                        </div>

                        <button
                            type="submit"
                            class="flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow hover:bg-emerald-700 disabled:cursor-not-allowed disabled:opacity-70"
                            x-bind:disabled="loading"
                        >
                            <span x-show="!loading">Confirmar pago</span>
                            <span x-show="loading" x-cloak>Procesando pago...</span>
                        </button>
                    </form>
                @else
                    <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        Esta factura ya esta pagada.
                    </div>
                @endif
            </div>
        </section>
    </div>
@endsection
