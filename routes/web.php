<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
// Ruta principal
Route::get('/', function () {
    return redirect()->route('inicio');
});

// Página inicio
Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');

// Rutas protegidas
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Panel administrador
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');

    // Administrar usuarios


});
 // Administrar usuarios
 Route::controller(AdminController::class)->group(function () {
    // Ruta para listar usuarios en el panel de administración de usuarios
    Route::get('/adminusuarios', 'listarUsuarios')->name('adminusuarios');
    // Ruta para actualizar un usuario específico en el panel de administración de usuarios
    Route::put('/adminusuarios/{id}', 'actualizarUsuario')->name('actualizarUsuario');
    // Ruta para eliminar un usuario específico en el panel de administración de usuarios
    Route::delete('/adminusuarios/{id}', 'eliminarUsuario')->name('eliminarUsuario');
});
// Login
Route::controller(LoginController::class)->group(function () {

    // Formulario login usuario
    Route::get('/login', 'cargarLogin')->name('login');

    // Formulario login admin
    Route::get('/loginAdmin', 'cargarLoginAdmin')->name('loginAdmin');

    // Registro
    Route::get('/registro', 'cargarRegistro')->name('registro');

    // Procesos login y registro
    Route::post('/loguear', 'loguear')->name('loguear');
    Route::post('/loguearAdmin', 'loguearAdmin')->name('loguearAdmin');
    Route::post('/registrar', 'registrar')->name('registrar');

    // Logout
    Route::post('/cerrar', 'cerrarSesion')->name('cerrar');
});
