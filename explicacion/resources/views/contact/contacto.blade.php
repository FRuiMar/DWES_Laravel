@include('cabecera')  <!-- siempre busca en views.. si es dentro de una carpeta sería.  carpeta-->
<h1>Hoy soy el contacto {{ $nom }} y tengo {{ $ed }} años</h1>  <!-- esto es con blade-->

@if($ed>=18)
    <p>Es mayor de edad </p>
@else
    <p>Es menor de edad</p>
@endif


<h1>Lista de Fruta</h1>

<ul>
    @foreach ( $frutas as $f)
        <li>{{ $f }}</li>
    @endforeach
</ul>
