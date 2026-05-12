<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController
{
    public function cargarLogin()
    {
        return view('login');
    }
    public function cargarRegistro()
    {
        return view('registro');
    }
    public function loguear(Request $res)
    {
        // Validación de datos
        // El campo 'email' se valida como un correo electrónico válido
        $res->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);
        // Si la validación es exitosa, se procede a intentar iniciar sesión
        try {

            if (Auth::attempt([
                'email' => $res->email,
                'password' => $res->password
            ])) {
                // Regenerar la sesión para evitar ataques de fijación de sesión
                $res->session()->regenerate();
                // Redirigir al dashboard después de iniciar sesión exitosamente
                return redirect()->route('dashboard');
            }
            // Si las credenciales son incorrectas, se redirige de vuelta con un mensaje de error
            return back()->with('mensaje', 'Datos incorrectos');
            // En caso de cualquier otro error, se captura la excepción y se muestra un mensaje de error
        } catch (\Throwable $th) {
            return back()->with('mensaje', 'Error: ' . $th->getMessage());
        }
    }
    public function registrar(Request $res)
    {
        // Validación de datos
        // El campo 'password_confirmation' se valida automáticamente con 'same:password'
        $res->validate([
            'nombre' => 'required',
            'email' => 'required|email:rfc,dns|unique:usuarios,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ]);
        // Si la validación es exitosa, se procede a crear el usuario
        try {

            $us = new Usuarios();
            $us->nombre = $res->nombre;
            $us->email = $res->email;
            // Hash de la contraseña antes de guardarla
            $us->password = Hash::make($res->password);
            $us->rol = 'U'; // Asignar rol de usuario por defecto
            // Guardar el usuario en la base de datos
            $us->save();
            // Iniciar sesión automáticamente después del registro
            Auth::login($us);
            // Redirigir al dashboard después de registrarse exitosamente
            return redirect()->route('dashboard');
        } catch (\Throwable $th) {
            // En caso de cualquier error, se captura la excepción y se muestra un mensaje de error
            return back()->with('mensaje', 'Error: ' . $th->getMessage());
        }
    }
    public function cerrarSesion()
    {
        // Cerrar sesión del usuario actual
        Auth::logout();
        // Redirigir a la página de inicio después de cerrar sesión
        return redirect(route('inicio'));
    }
}
