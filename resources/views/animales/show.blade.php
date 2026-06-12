@extends('layouts.app')

@section('title', $animal->nombre . ' — Portal de Adopciones')

@section('content')

<a href="{{ route('animales.index') }}"
   class="inline-block mb-8 text-violet-700 hover:text-violet-900 transition text-sm font-medium">
    ← Volver al listado
</a>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-4xl mx-auto">

    <div class="grid md:grid-cols-2 gap-10 items-start">

        {{-- Foto --}}
        <div>
            <x-animal-image :animal="$animal" class="w-full h-80 object-cover rounded-xl shadow-sm"/>
        </div>

        {{-- Datos --}}
        <div class="space-y-6">

            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-800 mb-2">{{ $animal->nombre }}</h1>

                @php $disponible = $animal->estado === 'disponible'; @endphp

                <span class="inline-block px-3 py-1 text-sm font-medium rounded-full
                    {{ $disponible ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $disponible ? 'Disponible' : 'Adoptado' }}
                </span>
            </div>

            <dl class="space-y-3 text-gray-600">
                <div class="flex gap-2">
                    <dt class="font-semibold text-gray-700 w-16">Tipo</dt>
                    <dd class="capitalize">{{ $animal->tipo }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-semibold text-gray-700 w-16">Edad</dt>
                    <dd>{{ $animal->edad }} año{{ $animal->edad !== 1 ? 's' : '' }}</dd>
                </div>
            </dl>

            @if($disponible)
                <a href="{{ route('solicitudes.create', $animal) }}"
                   class="inline-block px-5 py-2.5 bg-violet-700 text-white rounded-lg hover:bg-violet-800 transition text-sm font-semibold shadow-sm">
                    Adoptar a {{ $animal->nombre }}
                </a>
            @endif

            @auth
                @if(auth()->user()->isAdmin())
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('animales.edit', $animal) }}"
                           class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition text-sm font-medium">
                            Editar
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- Tarjeta de contacto del adoptante (solo admin, solo si está adoptado) --}}
    @auth
        @if(auth()->user()->isAdmin() && $solicitudAprobada)
            <div class="mt-10 pt-8 border-t border-gray-100">
                <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="text-violet-600">👤</span> Datos del adoptante
                </h2>
                <div class="bg-violet-50 border border-violet-100 rounded-xl p-6 grid sm:grid-cols-3 gap-4 text-sm">
                    <div>
                        <p class="text-xs font-semibold text-violet-600 uppercase tracking-wide mb-1">Nombre</p>
                        <p class="text-gray-800 font-medium">{{ $solicitudAprobada->adoptante->nombre }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-violet-600 uppercase tracking-wide mb-1">Email</p>
                        <a href="mailto:{{ $solicitudAprobada->adoptante->email }}"
                           class="text-violet-700 hover:underline">
                            {{ $solicitudAprobada->adoptante->email }}
                        </a>
                    </div>
                    @if($solicitudAprobada->adoptante->telefono)
                        <div>
                            <p class="text-xs font-semibold text-violet-600 uppercase tracking-wide mb-1">Teléfono</p>
                            <p class="text-gray-800">{{ $solicitudAprobada->adoptante->telefono }}</p>
                        </div>
                    @endif
                </div>
                <p class="mt-2 text-xs text-gray-400">
                    Solicitud aprobada el {{ $solicitudAprobada->updated_at->format('d/m/Y') }}
                </p>
            </div>
        @endif
    @endauth

</div>

@endsection
