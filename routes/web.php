<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
// Ruta de inicio que redirige a la ruta 'inicio'
Route::get('/', function () {
   return redirect()->route('inicio');
});
// Ruta para la página de inicio que muestra la vista 'inicio'
Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');
// Grupo de rutas protegidas por el middleware 'auth' para asegurar que solo los usuarios autenticados puedan acceder a ellas
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Ruta para la página de administración que muestra la vista 'admin'
    Route::get('/admin', function () {
        return view('admin');
    })->name('admin');
});

Route::controller(LoginController::class)->group(function(){
    // Ruta para mostrar el formulario de inicio de sesión usuario normal
    Route::get('/login','cargarLogin')->name('login');
    // Ruta para mostrar el formulario de inicio de sesión administrador
    Route::get('/loginAdmin','cargarLoginAdmin')->name('loginAdmin');
    Route::get('/registro','cargarRegistro')->name('registro');
    Route::post('/loguear','loguear')->name('loguear');
    Route::post('/loguearAdmin','loguearAdmin')->name('loguearAdmin');
    Route::post('/registrar','registrar')->name('registrar');
    Route::post('/cerrar','cerrarSesion')->name('cerrar');
});
