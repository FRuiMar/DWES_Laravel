<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory, softDeletes;
    protected $guarded = [];

    //Método para obtener el propietario del coche que es sólo uno.
    public function propietario()
    {
        return $this->belongsTo(User::class, 'user_id');  //la clave sería propietario_id.. pero tenemos user_id (lo hemos hecho así por probar), 
        //así que aquí que hemos creado el metodo propietario en vez de user.. ponemos al lado de class 'user_id'.
    }
}
