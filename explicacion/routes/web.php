<?php

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
}) ->name('inicio');   //se le puede poner un nombre a la ruta usando esta ->name (es opcional para luego usarlo al llamarlo más rápido)


Route::view('child','child');


//  ->  Route::view('/','welcome');   //versión simplificado de lo de arriba.. viene en la documentación en Lo Básico / Enrutamiento.



//creamos rutas para que la web muestre lo que queramos.. una web, un mensaje, etc
//se añaden parametros con /{nombredelparametro}
//si añado un ? al final del parametro, será opciónal, pero entonces en la función tenemos que darle un valor
//a la variable para que tenga ya uno por defecto en caso de que no pongamos el parametro.

Route::get('contacto/{nombre?}/{edad?}', function($nombre = "Fran", $edad=18){

        return view('contact.contacto')->with('nom',$nombre)->with('ed',$edad)->with('frutas', array('Manzana', 'Pera', 'Naranja'));  //Antonio suele usar este

        //nombre de la ruta (opcional)     //podemos poner condiciones para validar los parámetros de una ruta  usando ->where.
})->name('contacto') ->where([
    'nombre' => '[A-Za-z]+',
    'edad' => '[0-9]+',
]);

Route::view('componente', 'vista_componente');

//dentro del route get tienes estas opciones tb
/*
  //return "Hola, soy la página de contacto por GET de ".$nombre ." y tengo ". $edad. " años";  //ejemplo de cuando devuelve una cadena de texto (solo para ejemplo no se suele usar)

        // return view('contacto', ['nom'=>$nombre, 'edad'=>$edad]); //en vez de compact() antes se pasaba un array ['nom'=>$nombre, 'edad'=>$edad]
        //return view('contacto', compact('nombre', 'edad'));   //en compact nombre y edad sí se tienen que llamar igual

*/









// Route::post('contacto', function(){
//     return "Hola, soy la página de contacto por POST";

// })->withoutMiddleware([ValidateCsrfToken::class]);

    //se añade para evitar validar el token cuando se hace post. (si estás usando el Middleware del token).
    //al añadir el without haces una excepcion al uso del middleware en esta ruta.
    //el get no usa ese middleware.

