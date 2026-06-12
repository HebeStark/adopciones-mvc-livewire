@props([
    'animal',
    'class' => 'w-full h-56 object-cover',
])

@php
    $tipo      = $animal->tipo ?? 'generico';
    $fallback  = asset('images/placeholders/' . (in_array($tipo, ['perro', 'gato']) ? $tipo : 'generico') . '.svg');
    $src       = $animal->foto
        ? asset('storage/' . $animal->foto)
        : $fallback;
@endphp

<img
    src="{{ $src }}"
    alt="{{ $animal->nombre }}"
    class="{{ $class }}"
    onerror="this.onerror=null;this.src='{{ $fallback }}'"
>
