<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Actividades Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Nuestras Actividades</h1>

                    @if ($activities->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 dark:text-gray-400">No hay actividades disponibles en este momento.
                            </p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($activities as $activity)
                                <div
                                    class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden border border-gray-200 dark:border-gray-600">
                                    @if ($activity->image)
                                        <img src="{{ asset('storage/' . $activity->image) }}"
                                            alt="{{ $activity->name }}" class="w-full h-48 object-cover">
                                    @else
                                        <div
                                            class="w-full h-48 bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                                            <span
                                                class="text-gray-500 dark:text-gray-400 text-2xl font-bold">{{ substr($activity->name, 0, 1) }}</span>
                                        </div>
                                    @endif

                                    <div class="p-4">
                                        <h3 class="font-bold text-lg mb-2">{{ $activity->name }}</h3>

                                        <div class="mb-2">
                                            <span class="text-sm font-semibold">Horario:</span>
                                            <span class="text-sm">{{ $activity->schedule }}</span>
                                        </div>

                                        <div class="mb-2">
                                            <span class="text-sm font-semibold">Capacidad:</span>
                                            <span class="text-sm">{{ $activity->max_capacity }} personas</span>
                                        </div>

                                        @if ($activity->trainer)
                                            <div class="mb-4">
                                                <span class="text-sm font-semibold">Entrenador:</span>
                                                <span class="text-sm">{{ $activity->trainer->first_name }}
                                                    {{ $activity->trainer->last_name }}</span>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('reservations.store') }}" class="mt-4">
                                            @csrf
                                            <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                            <button type="submit"
                                                class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                                Reservar plaza
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
