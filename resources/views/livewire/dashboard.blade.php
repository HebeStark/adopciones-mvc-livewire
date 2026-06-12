<div class="max-w-5xl mx-auto">

    <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
    <p class="text-gray-400 text-sm mb-10">Resumen del portal de adopciones</p>

    <div class="grid gap-6 sm:grid-cols-3">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Disponibles</p>
            <p class="text-5xl font-extrabold text-violet-700">{{ $animalesDisponibles }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Pendientes</p>
            <p class="text-5xl font-extrabold text-yellow-500">{{ $solicitudesPendientes }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-md transition">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Adoptados</p>
            <p class="text-5xl font-extrabold text-green-600">{{ $animalesAdoptados }}</p>
        </div>

    </div>

    <div class="mt-10 flex gap-4 flex-wrap">
        <a href="{{ route('animales.create') }}"
           class="px-5 py-2.5 bg-violet-700 text-white rounded-lg hover:bg-violet-800 transition text-sm font-semibold shadow-sm">
            + Nuevo animal
        </a>
        <a href="{{ route('solicitudes.index') }}"
           class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium shadow-sm">
            Ver solicitudes →
        </a>
    </div>
</div>
