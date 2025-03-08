<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Actividades Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <!-- Cambiar max-w-screen-xl a max-w-screen-2xl o max-w-full para más ancho -->
        <div class="max-w-[90%] mx-auto px-4"> <!-- Aumentado el ancho máximo y simplificado el padding -->
            <div class="bg-white dark:bg-gray-800 bg-opacity-75 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">
                    <h2 class="text-3xl font-bold text-center mb-6">Nuestras Actividades</h2>

                    <!-- Manteniendo 4 columnas pero con más espacio -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @if ($activities->isEmpty())
                            <div class="col-span-4 text-center">
                                <p class="text-red-500 bg-white p-4 rounded shadow">No hay actividades disponibles en
                                    este momento.</p>
                            </div>
                        @else
                            @foreach ($activities as $activity)
                                <x-activity-card :activity="$activity" :showReservationButton="true" />
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
