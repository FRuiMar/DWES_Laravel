<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    {{-- <x-alert colortext="blue" colorbg="orange"/>   <!-- empieza por x para saber que es un componente.-->
    <x-alert colortext="green" colorbg="grey"/>   <!-- empieza por x para saber que es un componente.-->
    <x-alert colortext="yellow" colorbg="indigo"/>   <!-- empieza por x para saber que es un componente.-->
    <x-alert  colorbg="yellow"/>   <!-- empieza por x para saber que es un componente.-->
                 <!-- colortext es un nombre de variable(el que queramos) igual que colorbg-->


    <!-- Si queremos pasar dentro del componente --> --}}

    <?php
        $color = "red";
        $tipoalerta='alert';
    ?>

    <x-alert :colortext="$color" colorbg="blue" class="text-amber-700" > {{--  para poder ponerle una variable a colortext, tengo que poner : delante  :colortext = "$variable" --}}
                                                                            {{--  sólo puedo tener un parámetro, no puedes poner más.. .text-amber-700 otro parametro -> esto no funcionaria --}}

        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">CUIDADITO!!!!</h1>
        <x-slot name="texto">
            {{-- Si ponemos un x-slot con nombre, el resto tb deben llevar, por eso comento los de arriba, porque van a dar fallo.  --}}
            <h2>Esto es un ejemplo de slot con nombre</h2>
        </x-slot>
    </x-alert>

    {{--  <x-alert2 colortext="red" />
    <x-alert2 /> --}}

    <x-alert2>
        <x-slot name="entrada1">
            <h3>ENTRADA 1 TEXTO</h3>
        </x-slot>
        <x-slot name="entrada2">
            <h3>ENTRADA 2  JUR JUR JUR</h3>
        </x-slot>
        <h2>Titulo de la alerta 2</h2>
    </x-alert2>
    <x-dynamic-component :component="$tipoalerta">
        CUIDADO!!!   {{--  SLOT SIN NOMBRE --}}
        <x-slot name="texto">
            <h3>Esto es un componente de tipo dinámico</h3>
        </x-slot>
    </x-dynamic-component>

</body>
</html>
