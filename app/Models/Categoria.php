<?php

namespace App\Models;
use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Especificar el nombre de la tabla asociada al modelo
    // En este caso, se indica que la tabla se llama 'categorias'
        protected $table = 'categorias';

    protected $fillable = [
        'nombre'
    ];

    // una categoría tiene muchas publicaciones
    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'categoria_id');
    }
}
