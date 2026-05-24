<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuarios extends Authenticatable
{
    // Especifica el nombre de la tabla en la base de datos que este modelo representa
    // En este caso, se establece que el modelo Usuarios se corresponde con la tabla 'usuarios' en la base de datos
    // Esto es importante para que Laravel sepa qué tabla utilizar al realizar consultas relacionadas con este modelo
    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol'
    ];

    protected $hidden = [
        'password'
    ];

    public $timestamps = false;
}
