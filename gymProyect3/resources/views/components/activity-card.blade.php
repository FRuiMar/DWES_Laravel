<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        @if ($activity->image)
            <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->name }}"
                class="w-full h-48 object-cover mb-4 rounded">
        @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center mb-4 rounded">
                <span class="text-gray-500">Sin imagen</span>
            </div>
        @endif

        <h3 class="text-lg font-bold">{{ $activity->name }}</h3>
        <p class="mt-2 text-sm text-gray-600"><strong>Horario:</strong> {{ $activity->schedule }}</p>
        <p class="text-sm text-gray-600"><strong>Capacidad:</strong> {{ $activity->max_capacity }} personas</p>

        @if ($activity->trainer)
            <p class="mt-2 text-sm text-gray-600">
                <strong>Entrenador:</strong> {{ $activity->trainer->name }}
            </p>
        @endif

        <!-- Botón condicional según estado de autenticación -->
        @if ($showReservationButton)
            @auth
                <form method="POST" action="{{ route('reservations.store') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                        Reservar
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="mt-4 block text-center w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-200">
                    Iniciar sesión para reservar
                </a>
            @endauth
        @endif
    </div>
</div>
