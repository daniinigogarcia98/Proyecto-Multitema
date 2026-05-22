<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// El controlador AdminController es responsable de manejar las operaciones relacionadas con la administración de usuarios en la aplicación
// Esto incluye listar, actualizar y eliminar usuarios, así como cualquier otra funcionalidad relacionada con la gestión de usuarios que
// pueda ser necesaria en el panel de administración
class AdminController extends Controller
{
    // LISTAR USUARIOS
    public function listarUsuarios()
    {
        // Obtener todos los usuarios de la base de datos utilizando el modelo Usuarios
        $us = Usuarios::all();
        // Retornar la vista 'adminusuarios' y pasarle la variable 'usuarios' que contiene la lista de usuarios obtenida de la base de datos
        return view('adminusuarios', compact('us'));
    }

    // ACTUALIZAR USUARIOS
    public function actualizarUsuario(Request $res, $id)
    {
        // Buscar el usuario por su ID utilizando el modelo Usuarios
        $us = Usuarios::findOrFail($id);
        // Validar los datos recibidos en la solicitud
        $res->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'rol' => 'required'
        ]);
        // Evitar que el administrador principal (ID 1) pueda cambiar su propio rol a usuario normal
        if ($us->id == 1 && $res->rol != 'A') {
            // Si el usuario que se intenta actualizar es el administrador principal y se intenta cambiar su rol a usuario normal, redirigir de vuelta a la página de administración de usuarios con un mensaje de error
            return redirect()
                ->route('adminusuarios')
                ->with('error', 'No puedes cambiar el rol del administrador principal');
        }
        // Actualizar los campos del usuario con los datos recibidos en la solicitud
        $us->nombre = $res->nombre;
        $us->email = $res->email;
        $us->rol = $res->rol;

        // Si se proporciona una nueva contraseña, se actualiza el campo de contraseña del usuario
        if ($res->password != null) {

            $us->password = Hash::make($res->password);
        }
        // Guardar los cambios realizados en el usuario en la base de datos
        $us->save();
        // Redirigir de vuelta a la página de administración de usuarios con un mensaje de éxito indicando que el usuario ha sido actualizado correctamente
        return redirect()
            ->route('adminusuarios')
            ->with('success', 'Usuario actualizado');
    }

    // ELIMINAR USUARIOS
    public function eliminarUsuario($id)
    {
        // Buscar el usuario por su ID utilizando el modelo Usuarios
        $us = Usuarios::findOrFail($id);

        // Verificar si el usuario que se intenta eliminar es el administrador principal (ID 1)
        if ($us->id == 1) {
            // Si el usuario es el administrador principal, redirigir de vuelta a la página de administración de usuarios con un mensaje de error indicando que no se puede eliminar el administrador principal
            return redirect()
                ->route('adminusuarios')
                ->with('error', 'No puedes eliminar el administrador principal');
        }
        // Si el usuario no es el administrador principal, proceder a eliminarlo de la base de datos
        $us->delete();
        // Redirigir de vuelta a la página de administración de usuarios con un mensaje de éxito indicando que el usuario ha sido eliminado correctamente
        return redirect()
            ->route('adminusuarios')
            ->with('success', 'Usuario eliminado');
    }
}
