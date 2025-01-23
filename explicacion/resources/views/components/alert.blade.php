  <!-- ESTO ES LA VISTA DEL COMPONENTE  .LA CLASE ESTÁ EN APP/VIEW/COMPONENTS/ALERT.PHP     VA SIEMPRE ENTRE DIVS -->
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->

<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-{{ $colorbg }}-800 dark:text-{{ $colortext }}-400" role="alert">
    <span class="font-medium">Danger alert! {{ $slot }}</span> HOLA: {{ $texto }}
    <p {{ $attributes }}> Creado por Comares </p>

    <!-- Para ejecutar una función    se pone entre doble llaves pero con un DOLAR DELANTE... -->
    <h1 style="font-size: 45px">{{ $peligro() }} </h1>

</div>

