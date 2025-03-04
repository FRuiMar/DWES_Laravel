<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Membresía') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('memberships.update', $membership->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 dark:bg-red-900 dark:text-red-100 dark:border-red-700"
                                role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="max-w-2xl mx-auto">
                            <!-- Tipo de membresía -->
                            <div class="mb-6">
                                <x-input-label for="type" :value="__('Tipo de Membresía')" />
                                <x-text-input id="type" class="block mt-1 w-full" type="text" name="type"
                                    :value="old('type', $membership->type)" required autofocus :disabled="$membership->type === 'Sin membresía'" />
                                <x-input-error :messages="$errors->get('type')" class="mt-2" />

                                @if ($membership->type === 'Sin membresía')
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                        No puedes modificar el nombre de la membresía por defecto.
                                    </p>
                                @endif
                            </div>

                            <!-- Precio -->
                            <div class="mb-6">
                                <x-input-label for="price" :value="__('Precio (€)')" />
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <x-text-input id="price" class="block w-full pr-8" type="number" name="price"
                                        :value="old('price', $membership->price)" required step="0.01" min="0" />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <span class="text-gray-500 dark:text-gray-400">€</span>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <!-- Duración en meses -->
                            <div class="mb-6">
                                <x-input-label for="duration_months" :value="__('Duración (meses)')" />
                                <x-text-input id="duration_months" class="block mt-1 w-full" type="number"
                                    name="duration_months" :value="old('duration_months', $membership->duration_months)" required min="0" />
                                <x-input-error :messages="$errors->get('duration_months')" class="mt-2" />
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    Usar 0 para membresías sin duración específica.
                                </p>
                            </div>

                            @if ($membership->users->count() > 0)
                                <div
                                    class="p-4 border border-blue-200 dark:border-blue-800 rounded-md bg-blue-50 dark:bg-blue-900/30 mb-6">
                                    <h3 class="font-medium text-blue-800 dark:text-blue-300">Usuarios con esta membresía
                                    </h3>
                                    <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                                        Esta membresía está asignada a {{ $membership->users->count() }} usuario(s).
                                        Los cambios afectarán a todos los usuarios que tengan esta membresía asignada.
                                    </p>
                                    <a href="{{ route('memberships.show', $membership->id) }}"
                                        class="mt-2 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                        Ver lista de usuarios con esta membresía →
                                    </a>
                                </div>
                            @endif

                            <div class="flex items-center justify-end mt-8">
                                <a href="{{ url()->previous() }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 me-3">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Guardar Cambios') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
