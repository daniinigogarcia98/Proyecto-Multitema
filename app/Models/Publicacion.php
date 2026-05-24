<?php

namespace App\Models;
use App\Models\Usuarios;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
       protected $table = 'publicaciones';

    protected $fillable = [
        'titulo',
        'contenido',
        'usuario_id',
        'categoria_id'
    ];

    // RELACIÓN: usuario
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }

    // RELACIÓN: categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
}
