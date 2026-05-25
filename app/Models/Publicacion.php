<?php

namespace App\Models;
use App\Models\Usuarios;
use App\Models\Categoria;
use App\Models\Comentarios;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    // Especificar el nombre de la tabla asociada al modelo
    // En este caso, se indica que la tabla se llama 'publicaciones'
       protected $table = 'publicaciones';

    protected $fillable = [
        'titulo',
        'contenido',
        'usuario_id',
        'categoria_id'
    ];

    // una publicación pertenece a un usuario y un usuario tiene muchas publicaciones
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'usuario_id');
    }

    // una publicación pertenece a una categoría y una categoría tiene muchas publicaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class);
    }
}
