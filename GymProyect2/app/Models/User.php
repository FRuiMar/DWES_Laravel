<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'dni',
        'name',
        'email',
        'password',
        'role',
        'image',
        'membership_id',
    ];

    // Campos ocultos (no se incluyen en las respuestas JSON)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relación muchos a muchos con actividades (a través de la tabla pivote activity_user)
    public function activities()
    {
        return $this->belongsToMany(Activity::class, 'activity_user', 'user_id', 'activity_id')
            ->withPivot('reservation_date');
    }

    // Relación con membresías
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'membership_id');
    }
}
