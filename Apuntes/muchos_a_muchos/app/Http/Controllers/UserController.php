<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $profesor = User::find(Auth::id());
        $alumnos = $profesor->estudiantes->paginate(1);  //devuelve todos los alumnos que tiene el profesor logueado.(en paginas con 1 alumno en cada una)
        //si quieres sólo estudiantes con condiciones pones:
        //$alumnos = $profesor->estudiantes()->where('nota', '>', 5)->get(); //devuelve los alumnos con nota mayor a 5.
        //$alumnos = $profesor->estudiantes()->wherePivot('nota', '>', 5)->paginate(2); //devuelve los alumnos con nota mayor a 5 pero paginado con dos alumnos en cada página.
        return view('profesor.index')->with('alumnos', $alumnos); //se le pasa a la vista la variable alumnos con with.
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

    public function nota(){
        $profesor=User::find(Auth::id());
        $alumnos = $profesor->estudiantes; //devuelve todos los alumnos que tiene el profesor logueado. //IMPORTANTE****  devuelve repetido el estudiante, ya que el id es diferente 
        return view('profesor.nota')->with('alumnos', $alumnos); //esto sirve para devolver a la vista profesor.nota la variable alumnos.
    }

    public function putnota(Request $request){
        // $alumno = Student::find($request->alumnoid);  //el request es de los name del formulario en nota.blade.php. por eso es alumnoid.
        // $alumno -> profesores()->attach(Auth::id(),['asignatura'=>$request->asig, 'nota'=>$request->nota]); //el attach es para añadir a la tabla pivote.
        
        $profesor = User::find(Auth::id());
        $profesor->estudiantes()->attach($request->alumnoid, ['asignatura' => $request->asig, 'nota' => $request->nota]);

        return to_route('profesor.index');

    }

}
