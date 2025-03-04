<x-guest>
    <div class="w-full sm:max-w-7xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Nuestras Actividades</h1>

        <!-- Lista de Actividades -->
        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
            @foreach ($activities as $activity)
                <div class="activity-card">
                    <!-- Imagen de la actividad -->
                    @if ($activity->image)
                        <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}"
                            class="activity-image mb-4">
                    @endif

                    <!-- Nombre de la actividad -->
                    <h2 class="text-2xl font-semibold">{{ $activity->name }}</h2>

                    <!-- Horario -->
                    <p class="text-gray-600 mt-2">
                        <strong>Horario:</strong> {{ $activity->schedule }}
                    </p>

                    <!-- Capacidad máxima -->
                    <p class="text-gray-600 mt-2">
                        <strong>Capacidad:</strong> {{ $activity->max_capacity }} personas
                    </p>

                    <!-- Entrenador -->
                    <p class="text-gray-600 mt-2">
                        <strong>Entrenador:</strong> {{ $activity->trainer->name ?? 'Sin entrenador asignado' }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-guest>
