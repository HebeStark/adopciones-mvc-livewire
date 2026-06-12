@extends('layouts.app')

@section('title', 'Portal de Adopciones — Dale un hogar a quien lo necesita')

@section('content')

{{-- Hero --}}
<section class="text-center py-16 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="text-6xl mb-6">🐾</div>

        <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-gray-800 mb-4 leading-tight">
            Dale un hogar a<br>
            <span class="text-violet-700">quien lo necesita</span>
        </h1>

        <p class="text-lg text-gray-500 mb-10 leading-relaxed">
            En nuestro portal encontrarás perros y gatos esperando una familia.
            Cada adopción cambia dos vidas.
        </p>

        <a href="{{ route('animales.index') }}"
           class="inline-block px-8 py-3.5 bg-violet-700 text-white text-base font-semibold rounded-xl
                  shadow-md hover:bg-violet-800 hover:shadow-lg transition-all duration-200">
            Ver animales en adopción →
        </a>
    </div>
</section>

{{-- Sección de bienvenida --}}
<section class="mt-4 grid sm:grid-cols-3 gap-6 text-center">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="text-3xl mb-3">🏠</div>
        <h3 class="font-semibold text-gray-700 mb-1">Adopción responsable</h3>
        <p class="text-sm text-gray-400">Proceso sencillo para que animal y familia encajen perfectamente.</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="text-3xl mb-3">❤️</div>
        <h3 class="font-semibold text-gray-700 mb-1">Animales cuidados</h3>
        <p class="text-sm text-gray-400">Todos nuestros animales están sanos y listos para un nuevo hogar.</p>
    </div>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="text-3xl mb-3">✅</div>
        <h3 class="font-semibold text-gray-700 mb-1">Seguimiento post-adopción</h3>
        <p class="text-sm text-gray-400">Nos aseguramos de que la adaptación sea exitosa para todos.</p>
    </div>
</section>

@endsection
