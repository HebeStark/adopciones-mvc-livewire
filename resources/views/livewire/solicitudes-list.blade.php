<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold text-gray-800 mb-2">Solicitudes de adopción</h1>
    <p class="text-gray-400 text-sm mb-10">Gestiona las solicitudes pendientes de aprobación</p>

    @if(session()->has('success'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="mb-6 flex items-center justify-between p-4 rounded-lg bg-green-100 text-green-800 border border-green-200 shadow-sm text-sm">
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-4 text-green-600 hover:text-green-800">✕</button>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Animal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Adoptante</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-50">
                    @forelse($solicitudes as $solicitud)
                        @php $estado = $solicitud->estado; @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                {{ $solicitud->animal->nombre }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div>{{ $solicitud->adoptante->nombre }}</div>
                                <div class="text-xs text-gray-400">{{ $solicitud->adoptante->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full
                                    {{ $estado === 'pendiente' ? 'bg-yellow-100 text-yellow-700'
                                    : ($estado === 'aprobada' ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700') }}">
                                    {{ ucfirst($estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $solicitud->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                @if($estado === 'pendiente')
                                    <div class="flex gap-2">
                                        <button wire:click="aprobarSolicitud({{ $solicitud->id }})"
                                                wire:loading.attr="disabled"
                                                class="px-3 py-1.5 bg-green-600 text-white text-xs rounded-lg
                                                       hover:bg-green-700 transition shadow-sm font-semibold
                                                       disabled:opacity-60">
                                            Aprobar
                                        </button>
                                        <button wire:click="rechazarSolicitud({{ $solicitud->id }})"
                                                wire:loading.attr="disabled"
                                                class="px-3 py-1.5 bg-red-600 text-white text-xs rounded-lg
                                                       hover:bg-red-700 transition shadow-sm font-semibold
                                                       disabled:opacity-60">
                                            Rechazar
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="text-3xl mb-2">📋</div>
                                No hay solicitudes registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
