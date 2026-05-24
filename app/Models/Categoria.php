<?php

namespace App\Models;
use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
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
