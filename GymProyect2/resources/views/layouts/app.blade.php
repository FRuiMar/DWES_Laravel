<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Tailwind --}}
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    {{-- Flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body>* {
            background-image: url('/storage/fondos/fondo3.jpg');
            background-size: cover;
            /* Ajusta la imagen al tamaño de la pantalla */
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Para que el fondo no se desplace al hacer scroll */
            margin: 0;
            padding: 0;
        }
    </style>

</head>

<body class="font-sans antialiased"> {{-- style="background-image: url('/storage/fondos/fondo3.jpg'); background-size: cover; background-position: center; background-attachment: fixed;" --}}

    <div class="min-h-screen  "> {{--  bg-gray-100 dark:bg-gray-900 --}}
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
