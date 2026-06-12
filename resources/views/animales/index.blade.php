@extends('layouts.app')

@section('title', 'Animales en adopción — Portal de Adopciones')

@section('content')

<div class="flex flex-wrap justify-between items-center gap-4 mb-8">
    <h1 class="text-3xl font-bold tracking-tight text-gray-800">Animales en adopción</h1>
    @auth
        @if(auth()->user()->isAdmin())
            <a href="{{ route('animales.create') }}"
               class="px-4 py-2 bg-violet-700 text-white rounded-lg shadow-sm hover:bg-violet-800 transition text-sm font-semibold">
                + Nuevo animal
            </a>
        @endif
    @endauth
</div>

@if($animales->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-12 text-center text-gray-400">
        <div class="text-4xl mb-3">🐾</div>
        No hay animales disponibles en este momento.
    </div>
@else

    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($animales as $animal)
            @php $disponible = $animal->estado === 'disponible'; @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5
                        transition-all duration-200 overflow-hidden flex flex-col">

                <x-animal-image :animal="$animal" class="w-full h-52 object-cover"/>

                <div class="p-5 flex flex-col grow">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $animal->nombre }}</h2>

                    <p class="text-gray-400 text-sm mb-3 capitalize">
                        {{ $animal->tipo }} · {{ $animal->edad }} año{{ $animal->edad !== 1 ? 's' : '' }}
                    </p>

                    <span class="inline-block w-fit px-3 py-1 text-xs font-medium rounded-full mb-4
                        {{ $disponible ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $disponible ? 'Disponible' : 'Adoptado' }}
                    </span>

                    <div class="mt-auto flex flex-wrap gap-2">
                        @if($disponible)
                            <a href="{{ route('solicitudes.create', $animal) }}"
                               class="px-3 py-1.5 bg-violet-700 text-white rounded-lg hover:bg-violet-800 transition text-xs font-semibold">
                                Adoptar
                            </a>
                        @endif
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('animales.edit', $animal) }}"
                                   class="px-3 py-1.5 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition text-xs font-semibold">
                                    Editar
                                </a>
                            @endif
                        @endauth
                        <a href="{{ route('animales.show', $animal) }}"
                           class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition text-xs font-medium">
                            Ver detalle →
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($animales->hasPages())
        <div class="mt-8">
            {{ $animales->links() }}
        </div>
    @endif

@endif

@endsection
