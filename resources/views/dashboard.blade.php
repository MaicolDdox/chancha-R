@php($title = 'Catalogo de canchas')

@extends('layouts.client')

@section('content')
    <section class="flex flex-col gap-3 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">Catalogo de canchas</h1>
                <p class="text-sm text-slate-600">Explora opciones disponibles y filtra por deporte, categoria y zona.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-purple-700 hover:text-purple-600">
                Limpiar filtros
            </a>
        </div>
        @if (session('reservation_error'))
            <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('reservation_error') }}
            </div>
        @endif
    </section>

    <section class="mt-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form
            method="GET"
            action="{{ route('dashboard') }}"
            class="grid gap-4 md:grid-cols-2 xl:grid-cols-4"
            x-data="{}"
            x-ref="filtersForm"
            x-on:change.debounce.400ms="$refs.filtersForm.submit()"
        >
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Busqueda</label>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nombre de la cancha"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                    x-on:input.debounce.600ms="$refs.filtersForm.submit()"
                >
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Deporte</label>
                <select
                    name="sport_id"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
                    <option value="">Todos</option>
                    @foreach ($sports as $sport)
                        <option value="{{ $sport->id }}" @selected(request('sport_id') == $sport->id)>{{ $sport->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Categoria</label>
                <select
                    name="category_id"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
                    <option value="">Todas</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Ubicacion</label>
                <select
                    name="location"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
                    <option value="">Todas</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location }}" @selected(request('location') === $location)>{{ $location }}</option>
                    @endforeach
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Precio minimo</label>
                <input
                    type="number"
                    name="price_min"
                    value="{{ request('price_min') }}"
                    min="0"
                    step="0.01"
                    placeholder="0"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Precio maximo</label>
                <input
                    type="number"
                    name="price_max"
                    value="{{ request('price_max') }}"
                    min="0"
                    step="0.01"
                    placeholder="999"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Disponibilidad</label>
                <select
                    name="status"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
                    <option value="disponible" @selected($statusFilter === 'disponible')>Disponible</option>
                    <option value="mantenimiento" @selected($statusFilter === 'mantenimiento')>Mantenimiento</option>
                    <option value="ocupada" @selected($statusFilter === 'ocupada')>Ocupada</option>
                    <option value="all" @selected($statusFilter === 'all')>Todas</option>
                </select>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Fecha disponible</label>
                <input
                    type="datetime-local"
                    name="available_at"
                    value="{{ request('available_at') }}"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
            </div>
            <div class="space-y-2">
                <label class="text-xs font-semibold uppercase tracking-wide text-slate-500">Horas</label>
                <input
                    type="number"
                    name="available_hours"
                    value="{{ request('available_hours', 1) }}"
                    min="1"
                    max="{{ config('reservations.max_hours', 8) }}"
                    class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-purple-400 focus:outline-none focus:ring-2 focus:ring-purple-200"
                >
            </div>
        </form>
    </section>

    <section class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        @forelse ($zones as $zone)
            <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                <div class="relative h-44">
                    <img src="{{ $zone->image_url }}" alt="{{ $zone->name }}" class="h-full w-full object-cover">
                    <span class="absolute left-3 top-3 rounded-full px-3 py-1 text-xs font-semibold text-white {{ $zone->status === 'disponible' ? 'bg-emerald-500' : 'bg-slate-600' }}">
                        {{ ucfirst($zone->status) }}
                    </span>
                </div>
                <div class="space-y-3 p-5">
                    <div class="flex flex-wrap items-center gap-2 text-xs text-slate-500">
                        <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->sport?->name ?? 'Deporte' }}</span>
                        <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->category?->name ?? 'Categoria' }}</span>
                        <span class="rounded-full bg-slate-100 px-2 py-1">{{ $zone->location ?: 'Sin ubicacion' }}</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-900">{{ $zone->name }}</h3>
                    <p class="text-sm text-slate-600">{{ $zone->description ?: 'Sin descripcion registrada.' }}</p>
                    <div class="flex items-center justify-between">
                        <div class="text-lg font-semibold text-purple-600">
                            ${{ number_format($zone->price_per_hour, 0) }}
                            <span class="text-xs font-medium text-slate-500">/hora</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <a
                                href="{{ route('zones.show', $zone) }}"
                                class="rounded-full border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-700 hover:border-purple-200 hover:text-purple-700"
                            >
                                Ver detalles
                            </a>
                            <a
                                href="{{ route('reservations.create', ['zone' => $zone->id]) }}"
                                class="rounded-full bg-purple-600 px-3 py-1 text-xs font-semibold text-white shadow hover:bg-purple-700"
                            >
                                Reservar
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-3xl border border-dashed border-slate-200 bg-white p-6 text-center text-sm text-slate-500 md:col-span-2 xl:col-span-3">
                No hay canchas disponibles con los filtros actuales.
            </div>
        @endforelse
    </section>

    <div class="pt-6">
        {{ $zones->links() }}
    </div>
@endsection
