<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel - @yield('title')</title>
</head>
<body>
    @section('header')
        @include('layouts.cabecera')
    @show <!-- Muestra el contenido y le da a la plantilla hija la prioridad para añadir el contenido.  -->
    <div>
        @yield('content')
    </div>
    @section('footer')  <!-- AQUÍ YO PONGO LOS NOMBRES QUE ME DE LA GANA, SON SOLO PARA DEFINIR.. PUEDO PONER    FIN, EN VEZ DE FOOTER -->

        FOOTER DE LA PLANTILLA MAESTRA
    @show
</body>
</html>
