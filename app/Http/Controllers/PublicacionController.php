<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PublicacionController extends Controller
{
    // NUEVO MÉTODO PARA MOSTRAR EL FORMULARIO DE CREACIÓN DE PUBLICACIONES
    public function formularioCrear($id)
{
    $categoria = Categoria::findOrFail($id);
    return view('crear_publicacion', compact('categoria'));
}
    public function verCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);

        $publicaciones = Publicacion::with('usuario')
            ->where('categoria_id', $id)
            ->latest()
            ->get();

        return view('categoria', compact('categoria', 'publicaciones'));
    }
// NUEVO MÉTODO PARA CREAR PUBLICACIONES
// Este método recibe una solicitud POST con los datos de la nueva publicación, valida los datos,
    public function crearPublicacion(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'categoria_id' => 'required|exists:categorias,id'
        ]);

        Publicacion::create([
            'titulo' => $request->titulo,
            'contenido' => $request->contenido,
            'usuario_id' => Auth::id(),
            'categoria_id' => $request->categoria_id
        ]);

        return redirect()
            ->route('categoriaver', $request->categoria_id)
            ->with('success', 'Publicación creada');
    }
// NUEVO MÉTODO PARA ELIMINAR PUBLICACIONES
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
    public function editarPublicacion(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if (
            Auth::check() &&
            ($publicacion->usuario_id == Auth::id() || Auth::user()->rol == 'A')
        ) {
            $request->validate([
                'titulo' => 'required',
                'contenido' => 'required'
            ]);
// Si el usuario tiene permiso para editar la publicación, se actualizan los campos de título y contenido de la publicación con los datos recibidos en la solicitud
            $publicacion->update([
                'titulo' => $request->titulo,
                'contenido' => $request->contenido
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
    $publicacion = Publicacion::with('usuario')->findOrFail($id);

    return view('publicacion', compact('publicacion'));
}
// NUEVO MÉTODO PARA MOSTRAR LAS PUBLICACIONES DEL USUARIO AUTENTICADO
// Este método obtiene todas las publicaciones creadas por el usuario actualmente autenticado y las muestra en una vista específica para gestionar sus publicaciones.
public function misPublicaciones()
{
    $publicaciones = Publicacion::with('categoria')
        ->where('usuario_id', Auth::id())
        ->latest()
        ->get();

    return view('mispublicaciones', compact('publicaciones'));
}

}
