{{-- <h1>Hola, soy el contacto de <?php echo $name ?></h1> --}}
{{-- Si en vez de contacto.php lo llamamos contacto.blade.php, podemos usar la sintaxis de blade y no hace falta la de php--}}


{{-- <h1>Hola, soy el contacto de {{ $name }} {{ $apellido }}</h1> --}}

<h1>Hola, soy el contacto de {{ $name }} y tengo {{ $edad }} años</h1>


{{-- En Blade se puede usar includes, condicionales, bucles, etc ... usando   @      --}}


{{-- Incluir una vista dentro de otra --}}
@include('cabecera')


{{-- CONDICIONAL --}}
@if ($edad >= 18)
    <h2>Ya eres mayor de edad</h2>
@else
    <h2>Aun eres menor de edad</h2>
@endif

{{-- BUCLE --}}
<ul>
    @foreach ($frutas as $fruit)
        <li>{{ $fruit }}</li>
    @endforeach
