{{-- filepath: /c:/xampp/htdocs/DWES_Laravel/gymProyect3/resources/views/activities/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Actividad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('activities.update', $activity->id) }}" class="space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @if (session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 dark:bg-red-900 dark:text-red-100 dark:border-red-700"
                                role="alert">
                                <span class="block sm:inline">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="name" :value="__('Nombre de la Actividad')" />
                                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                        :value="old('name', $activity->name)" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="schedule" :value="__('Horario')" />
                                    <x-text-input id="schedule" class="block mt-1 w-full" type="text"
                                        name="schedule" :value="old('schedule', $activity->schedule)" required />
                                    <x-input-error :messages="$errors->get('schedule')" class="mt-2" />
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Ejemplo: Lunes y Miércoles
                                        18:00 - 19:30</p>
                                </div>

                                <div>
                                    <x-input-label for="max_capacity" :value="__('Capacidad Máxima')" />
                                    <x-text-input id="max_capacity" class="block mt-1 w-full" type="number"
                                        name="max_capacity" :value="old('max_capacity', $activity->max_capacity)" required min="1" />
                                    <x-input-error :messages="$errors->get('max_capacity')" class="mt-2" />

                                    @if ($activity->users->count() > 0)
                                        <p class="text-sm text-amber-600 dark:text-amber-400 mt-1">
                                            Esta actividad ya tiene {{ $activity->users->count() }} usuario(s)
                                            inscritos. Si reduces la capacidad por debajo de este número, no se podrán
                                            inscribir nuevos usuarios.
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <x-input-label for="trainer_id" :value="__('Entrenador Asignado')" />
                                    <select id="trainer_id" name="trainer_id"
                                        class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm">
                                        <option value="">Sin entrenador asignado</option>
                                        @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}"
                                                {{ old('trainer_id', $activity->trainer_id) == $trainer->id ? 'selected' : '' }}>
                                                {{ $trainer->first_name }} {{ $trainer->last_name }} -
                                                {{ $trainer->specialty }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('trainer_id')" class="mt-2" />
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <x-input-label for="image" :value="__('Imagen')" />

                                    <div class="mt-2 flex flex-col items-center space-y-4">
                                        <div class="w-48 h-48 overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-700">
                                            @if ($activity->image)
                                                <img id="preview-image" src="{{ asset('storage/' . $activity->image) }}"
                                                    alt="{{ $activity->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div id="preview-placeholder"
                                                    class="w-full h-full flex items-center justify-center">
                                                    <span class="text-gray-400 dark:text-gray-500">Sin imagen</span>
                                                </div>
                                                <img id="preview-image" src="" alt=""
                                                    class="w-full h-full object-cover hidden">
                                            @endif
                                        </div>

                                        <input id="image" type="file" name="image" class="hidden"
                                            accept="image/*" onchange="showPreview(this)">
                                        <label for="image"
                                            class="cursor-pointer px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                                            Seleccionar nueva imagen
                                        </label>

                                        @if ($activity->image)
                                            <div class="text-center text-sm text-gray-500 dark:text-gray-400">
                                                La imagen actual se reemplazará si seleccionas una nueva
                                            </div>
                                        @endif
                                    </div>

                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />

                                    <script>
                                        function showPreview(input) {
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                reader.onload = function(e) {
                                                    document.getElementById('preview-image').setAttribute('src', e.target.result);
                                                    document.getElementById('preview-image').classList.remove('hidden');
                                                    document.getElementById('preview-placeholder')?.classList.add('hidden');
                                                }
                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        }
                                    </script>
                                </div>

                                @if ($activity->users->count() > 0)
                                    <div
                                        class="p-4 border border-blue-200 dark:border-blue-800 rounded-md bg-blue-50 dark:bg-blue-900/30">
                                        <h4 class="font-medium text-blue-800 dark:text-blue-300">Participantes Actuales
                                        </h4>
                                        <p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                                            Esta actividad tiene {{ $activity->users->count() }} usuario(s) inscritos.
                                        </p>
                                        <a href="{{ route('activities.show', $activity->id) }}"
                                            class="mt-2 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                            Ver lista de participantes →
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ url()->previous() }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 focus:bg-gray-300 dark:focus:bg-gray-600 active:bg-gray-300 dark:active:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 me-3">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Actualizar Actividad') }}
                            </button>
                        </div>
                    </form>

                    {{-- El botón de eliminación lo dejamos fuera del formulario de actualización --}}
                    {{-- Solo se muestra en la vista show, no en el formulario de edición como en el users.edit --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const input = document.getElementById('image');
            const preview = document.getElementById('preview-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
