@extends('layouts.app')

@section('title', 'Editar ' . $animal->nombre . ' — Portal de Adopciones')

@section('content')

<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

    <h1 class="text-2xl font-bold text-gray-800 mb-8">Editar animal</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800 border border-red-200 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('animales.update', $animal) }}"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nombre --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $animal->nombre) }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
        </div>

        {{-- Tipo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
            <select name="tipo" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                <option value="">Seleccionar tipo</option>
                @foreach($tipos as $valor => $etiqueta)
                    <option value="{{ $valor }}" @selected(old('tipo', $animal->tipo) === $valor)>
                        {{ $etiqueta }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Edad --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Edad (años)</label>
            <input type="number" name="edad" value="{{ old('edad', $animal->edad) }}" min="0" max="30" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
        </div>

        {{-- Estado --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
            <select name="estado" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg
                           focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
                <option value="disponible" @selected(old('estado', $animal->estado) === 'disponible')>Disponible</option>
                <option value="adoptado"   @selected(old('estado', $animal->estado) === 'adoptado')>Adoptado</option>
            </select>
        </div>

        {{-- Foto con preview --}}
        <div x-data="{ previewUrl: '{{ $animal->foto ? asset('storage/' . $animal->foto) : '' }}' }">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Foto
                <span class="text-gray-400 font-normal">(opcional · jpg, png, webp · máx. 2 MB)</span>
            </label>

            {{-- Foto actual --}}
            <template x-if="previewUrl">
                <div class="mb-3">
                    <p class="text-xs text-gray-500 mb-1">Foto actual:</p>
                    <img :src="previewUrl" alt="Foto actual"
                         class="w-full max-h-56 object-cover rounded-xl border border-gray-200 shadow-sm">
                </div>
            </template>

            <input type="file"
                   name="foto"
                   accept="image/*"
                   class="block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-lg file:border-0
                          file:text-sm file:font-medium
                          file:bg-violet-50 file:text-violet-700
                          hover:file:bg-violet-100 cursor-pointer"
                   @change="previewUrl = $event.target.files[0]
                       ? URL.createObjectURL($event.target.files[0]) : previewUrl">

            <p class="text-xs text-gray-400 mt-1">Selecciona un nuevo archivo solo si quieres reemplazar la foto actual.</p>
        </div>

        <div class="flex justify-end gap-4 pt-6 border-t border-gray-100">
            <a href="{{ route('animales.index') }}"
               class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition text-sm font-medium">
                Cancelar
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-violet-700 text-white rounded-lg shadow-sm
                           hover:bg-violet-800 transition text-sm font-semibold">
                Guardar cambios
            </button>
        </div>
    </form>

    {{-- Eliminar --}}
    <div class="mt-8 pt-6 border-t border-gray-100">
        <form action="{{ route('animales.destroy', $animal) }}"
              method="POST"
              x-data="{ nombre: @js($animal->nombre) }"
              @submit.prevent="if(confirm('¿Seguro que quieres eliminar a ' + nombre + '?')) $el.submit()">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-sm text-sm font-medium">
                Eliminar animal
            </button>
        </form>
    </div>

</div>

@endsection
