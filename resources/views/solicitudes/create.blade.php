@extends('layouts.app')

@section('title', 'Solicitar adopción de ' . $animal->nombre)

@section('content')

<a href="{{ route('animales.show', $animal) }}"
   class="inline-block mb-8 text-violet-700 hover:text-violet-900 transition text-sm font-medium">
    ← Volver al detalle del animal
</a>

<livewire:solicitud-create :animal="$animal" />

@endsection
