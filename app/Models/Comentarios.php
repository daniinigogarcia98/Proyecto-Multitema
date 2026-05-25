<?php

namespace App\Models;
use App\Models\Usuarios;
use App\Models\Publicacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    // Especificar el nombre de la tabla asociada al modelo
    // En este caso, se indica que la tabla se llama 'comentarios'
        use HasFactory;
// Especificar el nombre de la tabla asociada al modelo
// En este caso, se indica que la tabla se llama 'comentarios'
    protected $table = 'comentarios';
// Especificar los campos que se pueden asignar masivamente
// En este caso, se indican los campos 'contenido', 'usuario_id' y 'publicacion_id'
    protected $fillable = [
        'contenido',
        'usuario_id',
        'publicacion_id'
    ];
// Un comentario pertenece a un usuario y un usuario tiene muchos comentarios
    public function usuario()
    {
        return $this->belongsTo(Usuarios::class);
    }
// Un comentario pertenece a una publicación y una publicación tiene muchos comentarios
    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class);
    }
}
