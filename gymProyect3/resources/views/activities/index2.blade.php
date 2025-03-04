<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Actividades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6 text-center">Actividades Disponibles</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($activities as $activity)
                            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                                <img src="{{ $activity->image ?? 'https://via.placeholder.com/300x200' }}"
                                    class="w-full h-48 object-cover" alt="{{ $activity->name }}">
                                <div class="p-4">
                                    <h5 class="text-xl font-semibold mb-2">{{ $activity->name }}</h5>
                                    <p class="text-gray-600 dark:text-gray-300 mb-2">Horario: {{ $activity->schedule }}
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-300 mb-4">Entrenador:
                                        {{ $activity->trainer->first_name ?? 'Sin asignar' }}</p>
                                    <a href="{{ route('activities.show', $activity->id) }}"
                                        class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                                        Ver más
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
