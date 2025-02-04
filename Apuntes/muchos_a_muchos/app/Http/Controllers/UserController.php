<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return "profesor.index";
    }



    public function create()
    {
        return view('profesor.create');
    }


    public function store(Request $request)
    {
        $newAlumno = new Student();
        $newAlumno->dni = $request->dni;
        $newAlumno->nombre = $request->name;
        $newAlumno->apellidos = $request->surname;
        $newAlumno->email = $request->email;
        $newAlumno->curso = $request->curso;
        $newAlumno->save();

        //para guardar datos en la tabla pivote //el alumno lo estamos creando en este momento.. el profesor es el logueado en la app.
        //la tabla pivote necesita el id del alumno y el id del profesor a parte de la asignatura y la nota.
        $newAlumno->profesores()->attach(Auth::id(), ['asignatura' => $request->asignatura, 'nota' => $request->nota]);
        //primer atributo la clave foranea (id del profesor) y el segundo atributo un array con  la asignatura y la nota.
        //el id del alumno ya esta en $newAlumno que es lo que se está creando.

        //si ya tuvieramos el alumno creado, lo buscamos y metemos en newAlumno
        //->   newAlumno = Student::find() y luego ya llamamos a lo mismo de arriba.


        return to_route('profesor.index');
    }
}
