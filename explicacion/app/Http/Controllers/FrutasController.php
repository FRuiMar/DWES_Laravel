<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormFrutasRequest;
use Illuminate\Http\Request;

class FrutasController extends Controller
{
    public function index()
    {
        return view('frutas.index')->with('frutas', array('Manzana', 'Pera', 'Naranja', 'Melon', 'Pomelo'));
    }

    public function naranjas($pais = "España")
    {
        return "Naranjas de " . $pais;
    }

    public function peras()
    {
        return "Peras";
    }

    public function store(FormFrutasRequest $request)
    {
        // if ($request->input('fruta') != "manzana") {
        //     return redirect()->route('frutas')->withInput()->with('mensaje', 'La fruta debe ser manazana');
        // }


        $request->validated();
       // $request->validate([
        //    'fruta' => 'required|min:5|max:10|in:manzana,peras',
        //    'descripcion' => 'required|min:10|max:20',
        //    'pais' => 'required',
       // ],$messages);






        return "TODO CORRECTO";


        //  return $request->input('fruta')." - ".$request->input('descir');

    }
}


