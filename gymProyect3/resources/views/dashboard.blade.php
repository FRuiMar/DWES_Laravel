<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                @if (Auth::user()->role === 'admin')
                    Admin Area
                @else
                    User Area
                @endif
            </h2>
            {{-- <h2 class="text-xl font-extrabold text-white">
                Bienvenido, {{ Auth::user()->name }}.
            </h2> --}}
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Eliminamos el fondo del contenedor principal -->
            <div class="overflow-hidden">

                <!-- Cards para usuarios ADMIN -->
                @if (Auth::user()->role === 'ADMIN')
                    <!-- Contenedor grid para las cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                        <!-- Card: Gestión de Usuarios -->
                        <a href="{{ route('users.index') }}" class="block">
                            <div class="bg-cover bg-center h-64 rounded-lg shadow-lg"
                                style="background-image: url('/storage/fondoAccDash/usuarios.jpg');">
                            </div>
                            <div class="mt-4 text-center">
                                <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                                    Gestión de Usuarios
                                </span>
                            </div>
                        </a>

                        <!-- Card: Gestión de Membresías -->
                        <a href="{{ route('memberships.index') }}" class="block">
                            <div class="bg-cover bg-center h-64 rounded-lg shadow-lg"
                                style="background-image: url('/storage/fondoAccDash/membresias.jpg');">
                            </div>
                            <div class="mt-4 text-center">
                                <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                                    Gestión de Membresías
                                </span>
                            </div>
                        </a>

                        <!-- Card: Gestión de Entrenadores -->
                        <a href="{{ route('trainers.index') }}" class="block">
                            <div class="bg-cover bg-center h-64 rounded-lg shadow-lg"
                                style="background-image: url('/storage/fondoAccDash/entrenadores.jpg');">
                            </div>
                            <div class="mt-4 text-center">
                                <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                                    Gestión de Entrenadores
                                </span>
                            </div>
                        </a>

                        <!-- Card: Gestión de Actividades -->
                        <a href="{{ route('activities.index') }}" class="block">
                            <div class="bg-cover bg-center h-64 rounded-lg shadow-lg"
                                style="background-image: url('/storage/fondoAccDash/actividades.jpeg');">
                            </div>
                            <div class="mt-4 text-center">
                                <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                                    Gestión de Actividades
                                </span>
                            </div>
                        </a>

                        <!-- Card: Gestión de Reservas -->
                        <a href="{{ route('user.admin.reservations') }}" class="block">
                            <div class="bg-cover bg-center h-64 rounded-lg shadow-lg"
                                style="background-image: url('/storage/fondoAccDash/reservas.jpg');">
                            </div>
                            <div class="mt-4 text-center">
                                <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                                    Gestión de Reservas
                                </span>
                            </div>
                        </a>
                    </div>
                @elseif(Auth::user()->role === 'NORMAL')
                    <!-- Contenido para usuarios NORMAL -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                        <div class="text-center">
                            <a href="{{ route('user.reservations') }}" class="block">
                                <div class="bg-cover bg-center h-64 rounded-lg shadow-lg"
                                    style="background-image: url('/storage/fondoAccDash/reservas.jpg');">
                                </div>
                                <div class="mt-4 text-center">
                                    <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                                        Mis Reservas
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
