@extends('layouts.master')

<!-- Para sustituir la secciones en la plantilla MASTER -->


@section('title', "Prueba" )  <!-- En Title sustituimos por Prueba-->


@section('contenido')
    <p>Aquí irá el contenido de la vista hija.</p>
@endsection <!-- Aquí en la plantilla hija, SÍ SE USA ENDSECTION -->

@section('footer')
         <!-- si queremos que se muestre la del padre, no redefinimos aquí el footer. -->
         <!-- si queremos que se muestren los dos,añadimos parent. -->
    @parent
    <p>Footer de la vista Hija </p>
@endsection  <!-- endsection define una zona, pero no la muestra. -->
