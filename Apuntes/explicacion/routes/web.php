<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;

Route::get('/', function () {
    return view('welcome');
})->name('inicio');


// Route::get('contacto', function () {
//     return "Soy la página de contacto";
// });





// Ruta que no necesita el token de CSRF, es decir, no necesita protección
// contra ataques de falsificación de solicitudes entre sitios

// Route::post('contacto', function () {
//     return "Se ha enviado el formulario de contacto";
// })->withoutMiddleware([ValidateCsrfToken::class]); //Si no pongo este WITHOUT middleware, me da un error 419 Page Expired

/*  Si no establecemos que no valide el CSRF Token, la aplicación mostrará una view indicando que la página a mostrar ha expirado.
     Laravel por defecto genera y válida dicho token para evitar falsificaciones o duplicados de un formulario otorgado por un Servidor.  */





// Route::get('contacto/{nombre}', function ($name) {   //La variable $name se pasa como argumento a la función anónima
//     return "Soy la página de contacto de $name";        //Si no ponemos la variable en la URL (el nombre), nos dará un error  404 Not Found
// });



//Si queremos que el parametro sea opcional, debemos poner un signo de interrogación
// Route::get('contacto/{nombre?}', function ($name = "Invitado") {     //Y la variable deberá estar inicializada en la función anónima
//     return "Soy la página de contacto de $name";
//     //Nombre de la ruta.. es opcional, pero es útil para hacer referencia a la ruta en el código
// })->name('contacto')
//     ->where(['nombre' => '[A-Za-z]+']);  //Podemos validar con Where.(En este caso que sólo haya letras en el nombre). 123 dara error 404 Not Found




// Route::get('contacto/{nombre?}/{apellido?}', function ($name = "Invitado", $apellido = "Inventado") {     //Y la variable deberá estar inicializada en la función anónima
//     //return "Soy la página de contacto de $name"; //en vez de un return con la frase.. vamos a enlazar una vista con la información


//     //Si ordenamos las vistas por careptas, debemos modificar la ruta de la vista (en vez de ->view('contacto').. ->view('contact.contacto'))
//     return view('contact/contacto', ['name' => $name, 'apellido' => $apellido]); //En la vista contacto.blade.php, vamos a recibir la variable name.(podemos cambiar el nombre de la variable en la vista..)
//     //return view ('contacto', compact('name')); //Otra forma de pasar la variable a la vista(no podemos cambiar el nombre de la variable en la vista.)
//     //return view ('contacto')->with('name', $name); //Otra forma de pasar la variable a la vista

// })->name('contacto')
//     ->where(['nombre' => '[A-Za-z]+']);




Route::get('contacto/{nombre?}/{edad?}', function ($name = "Invitado", $edad = "18") {

    //-----------------------------------------------------------------------------le podemos pasar un array con las variables que queremos pasar a la vista
    return view('contact/contacto', ['name' => $name, 'edad' => $edad, 'frutas' => ['naranja', 'pera', 'sandía', 'fresa', 'melón']]);           //En la vista contacto.blade.php, vamos a recibir la variable name.(podemos cambiar el nombre de la variable en la vista..)]);

    //return view ('contacto', compact('name')); //Otra forma de pasar la variable a la vista(no podemos cambiar el nombre de la variable en la vista.)
    //return view ('contacto')->with('name', $name); //Otra forma de pasar la variable a la vista

})->name('contacto')
    ->where(['nombre' => '[A-Za-z]+']);
