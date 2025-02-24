<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;

class CarList extends Component
{
    public $nombre; //TODAS LAS PROPIEDADES PUBLICAS QUE PONGA A LA CLASE DEL COMPONENTE SERÁN ACCESIBLES DESDE LA VISTA
    public $buscador;
    public function render()
    {
        $cars = Car::where('marca', 'like', '%' . $this->buscador . '%')->orWhere('modelo', 'like', '%' . $this->buscador . '%')->get(); //con where hago una consulta a la base de datos para que me devuelva los coches que cumplan la condición);
        return view('livewire.car-list')->with('cars', $cars); //con with le paso la variable cars a la vista para luego poder sacarlo en lista o como quiera.
    }
}
