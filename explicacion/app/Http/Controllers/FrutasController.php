<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


class FrutasController extends Controller
{
    public function index(){
        return view('frutas.index')->with('frutas',array('Manzana','Pera','Naranja','Melon','Pomelo'));
    }


    public function naranjas($pais="España"){
        return "Naranjas de ".$pais;
    }


    public function peras(){
        return "Peras";
    }


    public function store(Request $request){
        if($request->input('fruta')!="manzana"){
            return redirect()->route('frutas')->withInput();
        } else {
            return $request->all();


        }
      //  return $request->input('fruta')." - ".$request->input('descir');


    }
}




