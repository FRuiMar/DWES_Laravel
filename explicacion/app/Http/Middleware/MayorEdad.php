<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MayorEdad
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //aquí se pone la lógica de la validación  //si no es mayor de edad, redirigimos a la página de inicio
        if($request->route("edad")<18){
            return redirect()->route('inicio');
            //return response("No eres mayor de edad, 403);
        }
        return $next($request);
    }
}
