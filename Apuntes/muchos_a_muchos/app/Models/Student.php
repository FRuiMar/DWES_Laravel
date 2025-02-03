<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
   protected $guard=[];


   public function profesores()
   {
       return $this->belongsToMany(User::class)->withPivot('asignatura','nota');
   }
}
