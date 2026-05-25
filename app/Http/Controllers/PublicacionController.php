<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Comentarios;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller
{
    // metodo para crear publicaciones con un metodo llamado formularioCrearPublicacion que muestra el formulario
    public function formularioCrear($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('crear_publicacion', compact('categoria'));
    }
    // metodo para ver una categoria con sus publicaciones
    public function verCategoria($id)
    {
        // Buscar la categoría por su ID utilizando el modelo Categoria
        $categoria = Categoria::findOrFail($id);
        // Obtener las publicaciones asociadas a la categoría utilizando el modelo Publicacion

        $publicaciones = Publicacion::with('usuario')
            ->where('categoria_id', $id)
            ->latest()
            ->get();
        // Retornar la vista 'categoria' y pasarle las variables 'categoria' y 'publicaciones' que contienen la información de la categoría y sus publicaciones asociadas
        return view('categoria', compact('categoria', 'publicaciones'));
    }
    // MÉTODO PARA CREAR PUBLICACIONES
    // Este método recibe una solicitud POST con los datos de la nueva publicación, valida los datos,
    public function crearPublicacion(Request $res)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $res->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'categoria_id' => 'required|exists:categorias,id'
        ]);
        // Si la validación es exitosa, se crea una nueva publicación utilizando el modelo Publicacion, asignando el título, contenido, ID del usuario autenticado y ID de la categoría a la que pertenece la publicación
        Publicacion::create([
            'titulo' => $res->titulo,
            'contenido' => $res->contenido,
            'usuario_id' => Auth::id(),
            'categoria_id' => $res->categoria_id
        ]);

        return redirect()
            ->route('categoriaver', $res->categoria_id)
            ->with('success', 'Publicación creada');
    }
    // MÉTODO PARA ELIMINAR PUBLICACIONES
    // Este método permite eliminar una publicación específica, pero solo si el usuario autenticado es el autor de la publicación o tiene el rol de administrador. Si el usuario no tiene permiso para eliminar la publicación, se redirige de vuelta a la categoría con un mensaje de error.
    public function eliminarPublicacion($id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if (
            Auth::check() &&
            ($publicacion->usuario_id == Auth::id() || Auth::user()->rol == 'A')
        ) {
            $categoriaId = $publicacion->categoria_id;
            $publicacion->delete();

            return redirect()
                ->route('categoriaver', $categoriaId)
                ->with('success', 'Publicación eliminada');
        }

        return redirect()
            ->route('categoriaver', $publicacion->categoria_id)
            ->with('error', 'No tienes permiso para eliminar esta publicación');
    }
    // NUEVO MÉTODO PARA EDITAR PUBLICACIONES
    // Este método permite editar una publicación específica, pero solo si el usuario autenticado es el autor de la publicación o tiene el rol de administrador. Si el usuario no tiene permiso para editar la publicación, se redirige de vuelta a la categoría con un mensaje de error.
    public function editarPublicacion(Request $res, $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if (
            Auth::check() &&
            ($publicacion->usuario_id == Auth::id() || Auth::user()->rol == 'A')
        ) {
            $res->validate([
                'titulo' => 'required',
                'contenido' => 'required'
            ]);
            // Si el usuario tiene permiso para editar la publicación, se actualizan los campos de título y contenido de la publicación con los datos recibidos en la solicitud
            $publicacion->update([
                'titulo' => $res->titulo,
                'contenido' => $res->contenido
            ]);
            // Después de editar la publicación, se redirige a la vista de la categoría a la que pertenece la publicación con un mensaje de éxito
            return redirect()
                ->route('categoriaver', $publicacion->categoria_id)
                ->with('success', 'Publicación editada');
        }
        // Si el usuario no tiene permiso para editar la publicación, se redirige de vuelta a la categoría con un mensaje de error
        return redirect()
            ->route('categoriaver', $publicacion->categoria_id)
            ->with('error', 'No tienes permiso para editar esta publicación');
    }
    public function verPublicacion($id)
    {
        // Buscar la publicación por su ID utilizando el modelo Publicacion, incluyendo las relaciones con el usuario que la creó y los comentarios asociados a la publicación, junto con los usuarios que hicieron esos comentarios
        $publicacion = Publicacion::with([
            'usuario',
            'comentarios.usuario'
        ])->findOrFail($id);

        return view('publicacion', compact('publicacion'));
    }
    //  MÉTODO PARA MOSTRAR LAS PUBLICACIONES DEL USUARIO AUTENTICADO
    // Este método obtiene todas las publicaciones creadas por el usuario actualmente autenticado y las muestra en una vista específica para gestionar sus publicaciones.
    public function misPublicaciones()
    {
        $publicaciones = Publicacion::with('categoria')
            ->where('usuario_id', Auth::id())
            ->latest()
            ->get();

        return view('mispublicaciones', compact('publicaciones'));
    }
    public function guardarComentario(Request $res, $id)
    {
        // Verificar si el usuario está autenticado antes de permitir guardar un comentario
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $res->validate([
            'contenido' => 'required|string'
        ]);

        Comentarios::create([
            'contenido' => $res->contenido,
            'usuario_id' => Auth::id(),
            'publicacion_id' => $id
        ]);

        return redirect()->back();
    }
}
