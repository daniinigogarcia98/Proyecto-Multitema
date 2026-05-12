<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = [
        // Campos que se pueden asignar masivamente
        'nombre',
        'email',
        'password',
        'rol'
    ];

    protected $hidden = [
        // Campos que se ocultan al convertir el modelo a un array o JSON
        'password'
    ];

    public $timestamps = false;
}
