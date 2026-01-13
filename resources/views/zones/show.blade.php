@php($title = 'Detalle de cancha')

@extends('layouts.client')

@section('content')
    <section class="grid gap-6 lg:grid-cols-2">
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <img src="{{ $imageUrl }}" alt="{{ $zone->name }}" class="h-72 w-full object-cover">
            <div class="p-6">
                <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                    <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->sport?->name ?? 'Deporte' }}</span>
                    <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->category?->name ?? 'Categoria' }}</span>
                    <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->location ?: 'Sin ubicacion' }}</span>
                </div>
                <h1 class="mt-4 text-2xl font-semibold text-slate-900">{{ $zone->name }}</h1>
                <p class="mt-3 text-sm text-slate-600">{{ $zone->description ?: 'Sin descripcion registrada.' }}</p>
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold text-slate-900">Informacion clave</h2>
            <div class="mt-4 space-y-3 text-sm text-slate-600">
                <div class="flex items-center justify-between">
                    <span>Estado</span>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $zone->status === 'disponible' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                        {{ ucfirst($zone->status) }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Precio por hora</span>
                    <span class="text-lg font-semibold text-purple-600">${{ number_format($zone->price_per_hour, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Ubicacion</span>
                    <span>{{ $zone->location ?: 'Sin ubicacion' }}</span>
                </div>
            </div>

            <div class="mt-6 flex flex-col gap-3">
                <a href="{{ route('reservations.create', ['zone' => $zone->id]) }}" class="rounded-2xl bg-purple-600 px-4 py-3 text-center text-sm font-semibold text-white shadow hover:bg-purple-700">
                    Reservar esta cancha
                </a>
                <a href="{{ route('dashboard') }}" class="rounded-2xl border border-slate-200 px-4 py-3 text-center text-sm font-semibold text-slate-700 hover:border-purple-200 hover:text-purple-700">
                    Volver al catalogo
                </a>
            </div>
        </div>
    </section>
@endsection
