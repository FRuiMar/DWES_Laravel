<?php

use App\Http\Middleware\MayorEdad; //importamos el middleware que hemos creado
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )


    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['mayor' =>MayorEdad::class]); //añadimos el middleware que hemos creado
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
