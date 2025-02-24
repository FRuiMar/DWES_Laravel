<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Poner nota a los alumnos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('profesor.nota') }}" method="POST">
                        @csrf

                        <label for="alumno">Alumno:</label>
                        <select name="alumno" id="alumno" class="form-select">
                            @foreach ($alumnos as $alum)
                                <option value="{{ $alum->id }}">{{ $alum->nombre }} {{ $alum->apellido }}</option>
                            @endforeach
                        </select>

                        <label for="asignatura">Asignatura:</label>
                        <input type="text" name="asignatura" id="asignatura" class="form-input">

                        <label for="nota">Nota:</label>
                        <input type="text" name="nota" id="nota" class="form-input">

                        <input type="submit" value="Guardar" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
