<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

    <h2 class="text-2xl font-bold text-gray-800 mb-8">Solicitud de adopción</h2>

    <div class="mb-8 p-4 bg-violet-50 border border-violet-100 rounded-xl text-sm text-gray-700 flex items-center gap-3">
        <span class="text-2xl">🐾</span>
        <div>
            <span class="font-semibold text-violet-700">Animal seleccionado:</span>
            {{ $animal->nombre }}
            <span class="text-gray-400 capitalize">({{ $animal->tipo }})</span>
        </div>
    </div>

    <form wire:submit.prevent="save" class="space-y-5">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
            <input type="text"
                   wire:model="nombre"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
            @error('nombre')
                <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email"
                   wire:model="email"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
            @error('email')
                <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
            <input type="tel"
                   wire:model="telefono"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg
                          focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500">
            @error('telefono')
                <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="w-full px-6 py-3 bg-violet-700 text-white rounded-xl shadow-sm
                           hover:bg-violet-800 transition font-semibold
                           disabled:opacity-60 disabled:cursor-not-allowed"
                    wire:loading.attr="disabled">
                <span wire:loading.remove>Enviar solicitud</span>
                <span wire:loading class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                    </svg>
                    Enviando...
                </span>
            </button>
        </div>

    </form>
</div>
