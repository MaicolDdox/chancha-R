@php($title = 'Reservar cancha')

@extends('layouts.client')

@section('content')
    <div
        x-data="reservationState({
            zone: @json($zoneData),
            taxRate: @json($taxRate),
            startAt: @json(old('start_at')),
            hours: @json((int) old('hours', 1)),
            customerName: @json(old('customer_name', auth()->user()->name ?? '')),
            customerPhone: @json(old('customer_phone', '')),
            notes: @json(old('notes', '')),
        })"
        class="space-y-6"
    >
        @if (session('reservation_error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('reservation_error') }}
            </div>
        @endif

        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Reservar cancha</h1>
                    <p class="text-sm text-slate-600">Confirma la informacion, selecciona fecha y genera la factura.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-purple-700 hover:text-purple-600">
                    Volver al catalogo
                </a>
            </div>
        </section>

        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-6 lg:grid-cols-[260px_1fr]">
                <img src="{{ $imageUrl }}" alt="{{ $zone->name }}" class="h-full min-h-[220px] w-full object-cover">
                <div class="p-6">
                    <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                        <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->sport?->name ?? 'Deporte' }}</span>
                        <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->category?->name ?? 'Categoria' }}</span>
                        <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->location ?: 'Sin ubicacion' }}</span>
                    </div>
                    <h2 class="mt-3 text-xl font-semibold text-slate-900">{{ $zone->name }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $zone->description ?: 'Sin descripcion registrada.' }}</p>
                    <div class="mt-4 text-lg font-semibold text-purple-600">
                        ${{ number_format($zone->price_per_hour, 2) }} <span class="text-xs font-medium text-slate-500">/hora</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-xl font-semibold text-slate-900">Formulario de reserva</h3>
                <p class="text-sm text-slate-600">Completa los datos para confirmar el horario.</p>

                <form method="POST" action="{{ route('reservations.store') }}" class="mt-6 space-y-4">
                    @csrf
                    <input type="hidden" name="zone_id" value="{{ $zone->id }}">

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Fecha y hora de inicio</label>
                        <input
                            type="datetime-local"
                            name="start_at"
                            x-model="reservation.start_at"
                            value="{{ old('start_at') }}"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        >
                        @error('start_at')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Horas</label>
                        <select
                            name="hours"
                            x-model.number="reservation.hours"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        >
                            @for ($hour = 1; $hour <= $maxHours; $hour++)
                                <option value="{{ $hour }}">{{ $hour }} hora{{ $hour > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                        @error('hours')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="space-y-2">
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Nombre de contacto</label>
                            <input
                                type="text"
                                name="customer_name"
                                x-model="reservation.customer_name"
                                value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                            >
                            @error('customer_name')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Telefono</label>
                            <input
                                type="text"
                                name="customer_phone"
                                x-model="reservation.customer_phone"
                                value="{{ old('customer_phone') }}"
                                class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                            >
                            @error('customer_phone')
                                <p class="text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Notas</label>
                        <textarea
                            name="notes"
                            rows="3"
                            x-model="reservation.notes"
                            class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                        ></textarea>
                        @error('notes')
                            <p class="text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full rounded-2xl bg-purple-600 px-4 py-3 text-sm font-semibold text-white shadow hover:bg-purple-700">
                        Generar reserva y factura
                    </button>
                </form>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-xl font-semibold text-slate-900">Factura dinamica</h3>
                <p class="text-sm text-slate-600">Vista previa basada en tu seleccion.</p>

                <div class="mt-6 space-y-3 rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm">
                    <div class="flex items-center justify-between text-slate-600">
                        <span>Precio por hora</span>
                        <span class="font-semibold" x-text="formatMoney(zone ? zone.price_per_hour : 0)"></span>
                    </div>
                    <div class="flex items-center justify-between text-slate-600">
                        <span>Horas</span>
                        <span class="font-semibold" x-text="reservation.hours"></span>
                    </div>
                    <div class="flex items-center justify-between text-slate-600">
                        <span>Subtotal</span>
                        <span class="font-semibold" x-text="formatMoney(subtotal)"></span>
                    </div>
                    <div class="flex items-center justify-between text-slate-600">
                        <span>Impuestos ({{ (int) ($taxRate * 100) }}%)</span>
                        <span class="font-semibold" x-text="formatMoney(taxes)"></span>
                    </div>
                    <div class="flex items-center justify-between text-base font-semibold text-slate-900">
                        <span>Total</span>
                        <span x-text="formatMoney(total)"></span>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
