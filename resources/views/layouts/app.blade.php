<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Portal de Adopciones')</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 flex flex-col" style="font-family: 'Inter', sans-serif">

    {{-- Navbar --}}
    <nav class="bg-violet-700 text-white shadow-lg" x-data="{ open: false }">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight flex items-center gap-2">
                <span>🐾</span> Adopciones
            </a>

            {{-- Desktop menu --}}
            @php
                $base     = 'px-4 py-2 rounded-lg transition text-sm font-medium';
                $active   = 'bg-white text-violet-700 font-semibold shadow-sm';
                $inactive = 'text-white/90 hover:bg-violet-600';
            @endphp
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('home') }}"
                   class="{{ $base }} {{ request()->routeIs('home') ? $active : $inactive }}">
                    Inicio
                </a>
                <a href="{{ route('animales.index') }}"
                   class="{{ $base }} {{ request()->routeIs('animales.*') ? $active : $inactive }}">
                    Animales
                </a>
                @guest
                    <a href="{{ route('login') }}"
                       class="{{ $base }} {{ request()->routeIs('login') ? $active : $inactive }}">
                        Login
                    </a>
                @endguest
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('dashboard') }}"
                           class="{{ $base }} {{ request()->routeIs('dashboard') ? $active : $inactive }}">
                            Dashboard
                        </a>
                        <a href="{{ route('solicitudes.index') }}"
                           class="{{ $base }} {{ request()->routeIs('solicitudes.*') ? $active : $inactive }}">
                            Solicitudes
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="{{ $base }} {{ $inactive }}">Logout</button>
                    </form>
                @endauth
            </div>

            {{-- Hamburger button (mobile) --}}
            <button class="md:hidden p-2 rounded-lg hover:bg-violet-600 transition"
                    @click="open = !open"
                    aria-label="Menú">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="open"
             x-transition:enter="transition ease-out duration-150"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-100"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-violet-600 px-6 pb-4 pt-2 space-y-1">
            <a href="{{ route('home') }}"
               class="block {{ $base }} {{ request()->routeIs('home') ? $active : $inactive }}">Inicio</a>
            <a href="{{ route('animales.index') }}"
               class="block {{ $base }} {{ request()->routeIs('animales.*') ? $active : $inactive }}">Animales</a>
            @guest
                <a href="{{ route('login') }}"
                   class="block {{ $base }} {{ request()->routeIs('login') ? $active : $inactive }}">Login</a>
            @endguest
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('dashboard') }}"
                       class="block {{ $base }} {{ request()->routeIs('dashboard') ? $active : $inactive }}">Dashboard</a>
                    <a href="{{ route('solicitudes.index') }}"
                       class="block {{ $base }} {{ request()->routeIs('solicitudes.*') ? $active : $inactive }}">Solicitudes</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left {{ $base }} {{ $inactive }}">Logout</button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="grow max-w-6xl mx-auto w-full px-6 py-10">

        {{-- Flash banners --}}
        @if(session('success'))
            <div x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 4000)"
                 x-show="show"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="mb-6 flex items-center justify-between p-4 rounded-lg bg-green-100 text-green-800 border border-green-200 shadow-sm">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 text-green-600 hover:text-green-800 transition">✕</button>
            </div>
        @endif

        @if(session('error'))
            <div x-data="{ show: true }"
                 x-init="setTimeout(() => show = false, 4000)"
                 x-show="show"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="mb-6 flex items-center justify-between p-4 rounded-lg bg-red-100 text-red-800 border border-red-200 shadow-sm">
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="ml-4 text-red-600 hover:text-red-800 transition">✕</button>
            </div>
        @endif

        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset

    </main>

    <footer class="bg-white border-t mt-12">
        <div class="max-w-6xl mx-auto px-6 py-6 text-center text-gray-400 text-sm">
            &copy; {{ date('Y') }} Portal de Adopciones — Dale un hogar a quien lo necesita 🐾
        </div>
    </footer>

    @livewireScripts
</body>
</html>
