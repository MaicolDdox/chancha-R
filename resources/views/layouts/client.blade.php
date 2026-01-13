<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'ReservaDeportiva') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
            <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8" x-data="{ open: false }">
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-purple-600 to-blue-600 text-white shadow">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </span>
                        <span class="text-lg font-semibold tracking-tight text-slate-900">ReservaDeportiva</span>
                    </a>
                </div>

                <div class="hidden items-center gap-2 md:flex">
                    <a href="{{ route('dashboard') }}" class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-700 hover:bg-purple-50 hover:text-purple-700' }}">
                        Catalogo
                    </a>
                    <a href="{{ route('reservations.index') }}" class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->routeIs('reservations.*') ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-700 hover:bg-purple-50 hover:text-purple-700' }}">
                        Mis reservaciones
                    </a>
                    <a href="{{ route('invoices.index') }}" class="rounded-full px-4 py-2 text-sm font-medium transition {{ request()->routeIs('invoices.*') ? 'bg-purple-600 text-white shadow-sm' : 'text-slate-700 hover:bg-purple-50 hover:text-purple-700' }}">
                        Recibos
                    </a>
                </div>

                <div class="hidden items-center gap-3 md:flex" x-data="{ open: false }">
                    <button type="button" class="flex items-center gap-3 rounded-full border border-slate-200 bg-white px-3 py-2 text-sm font-medium shadow-sm transition hover:border-purple-200 hover:text-purple-700" x-on:click="open = !open">
                        <span class="flex h-8 w-8 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-blue-500 text-white">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </span>
                        <span class="max-w-[120px] truncate text-left">{{ Auth::user()->name ?? 'Usuario' }}</span>
                        <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div class="absolute right-6 top-16 w-52 rounded-2xl border border-slate-200 bg-white p-2 shadow-xl" x-show="open" x-on:click.outside="open = false" x-cloak>
                        @if (Route::has('profile.edit'))
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm text-slate-700 hover:bg-purple-50 hover:text-purple-700">
                                Perfil
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="mt-1 flex w-full items-center gap-3 rounded-xl px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                                Cerrar sesion
                            </button>
                        </form>
                    </div>
                </div>

                <button type="button" class="flex items-center rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 shadow-sm md:hidden" x-on:click="open = !open">
                    Menu
                </button>

                <div class="absolute left-0 right-0 top-[62px] z-40 border-b border-slate-200 bg-white shadow md:hidden" x-show="open" x-cloak>
                    <div class="flex flex-col gap-2 px-4 py-4">
                        <a href="{{ route('dashboard') }}" class="rounded-xl px-4 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-purple-600 text-white' : 'text-slate-700 hover:bg-purple-50' }}">
                            Catalogo
                        </a>
                        <a href="{{ route('reservations.index') }}" class="rounded-xl px-4 py-2 text-sm font-medium {{ request()->routeIs('reservations.*') ? 'bg-purple-600 text-white' : 'text-slate-700 hover:bg-purple-50' }}">
                            Mis reservaciones
                        </a>
                        <a href="{{ route('invoices.index') }}" class="rounded-xl px-4 py-2 text-sm font-medium {{ request()->routeIs('invoices.*') ? 'bg-purple-600 text-white' : 'text-slate-700 hover:bg-purple-50' }}">
                            Recibos
                        </a>
                        <div class="border-t border-slate-200 pt-2 text-sm text-slate-600">
                            {{ Auth::user()->email ?? '' }}
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-xl px-4 py-2 text-left text-sm font-medium text-red-600 hover:bg-red-50">
                                Cerrar sesion
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        <main class="mx-auto w-full max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-4 py-6 text-sm text-slate-500 sm:flex-row sm:px-6 lg:px-8">
                <div class="flex items-center gap-2 text-slate-600">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-gradient-to-br from-purple-600 to-blue-600 text-white">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </span>
                    ReservaDeportiva
                </div>
                <div>&copy; {{ date('Y') }} ReservaDeportiva. Todos los derechos reservados.</div>
            </div>
        </footer>
    </body>
</html>
