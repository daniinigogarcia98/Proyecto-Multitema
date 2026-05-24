<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublicacionController;
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
Route::middleware(['auth', 'usuario'])->group(function () {

    // Ruta para el dashboard esta ruta es para los usuarios normales
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
Route::controller(PublicacionController::class)->group(function () {
    // Ruta para ver categoria
    Route::get('/categoria/{id}','verCategoria')->name('categoriaver');
    // Ruta para crear publicaciones con un metodo llamado formularioCrearPublicacion que muestra el formulario
    Route::get('/publicaciones/{id}/crear', 'formularioCrear')->name('formularioCrearPublicacion');
    // ruta para crear publicaciones con un metodo llamado crearPublicacion que procesa el formulario y guarda la publicacion en la base de datos
    Route::post('/publicaciones', 'crearPublicacion')->name('crearPublicacion');
    // Ruta para editar publicaciones con un metodo llamado formularioEditarPublicacion que muestra el formulario de edicion
    Route::put('/publicaciones/{id}', 'editarPublicacion')->name('editarPublicacion');
    // Ruta para eliminar publicaciones con un metodo llamado eliminarPublicacion que elimina la publicacion de la base de datos
    Route::delete('/publicaciones/{id}', 'eliminarPublicacion')->name('eliminarPublicacion');
    // Ruta para ver una publicacion con un metodo llamado verPublicacion que muestra los detalles de la publicacion
    Route::get('/publicacion/{id}', 'verPublicacion')->name('verPublicacion');
    // Ruta para ver mis publicaciones con un metodo llamado misPublicaciones que muestra las publicaciones creadas por el usuario autenticado
    Route::get('/mispublicaciones', 'misPublicaciones')->name('mispublicaciones');

});
// Administrar usuarios
// Las rutas para administrar usuarios están protegidas por el middleware 'admin'.
// Esto significa que solo los usuarios autenticados con el rol de administrador podrán acceder a estas rutas
// Esto garantiza que solo los administradores puedan listar, actualizar y eliminar usuarios en la aplicación, mientras que los usuarios normales no tendrán acceso a estas funcionalidades de administración.
Route::middleware(['auth', 'admin'])
    ->controller(AdminController::class)
    ->group(function () {

        // Panel administrador esta ruta es para los administradores administramos el foro desde esta ruta
        // gestion de usuarios,administrar publicaciones,ect
        Route::get('/admin', function () {
            return view('admin');
        })->name('admin');
        // Ruta para listar usuarios obtenemos la lista de usuarios de la base de datos con el metodo GET y la funcion listarUsuarios del AdminController
        Route::get('/adminusuarios', 'listarUsuarios')
            ->name('adminusuarios');
        // Ruta para actualizar usuarios obtenemos el ID del usuario a actualizar con el metodo PUT y la funcion actualizarUsuario del AdminController
        //Put se utiliza para actualizar recursos existentes, en este caso, para actualizar los datos de un usuario específico identificado por su ID.
        Route::put('/adminusuarios/{id}', 'actualizarUsuario')
            ->name('actualizarUsuario');
        // Ruta para eliminar usuarios obtenemos el ID del usuario a eliminar con el metodo DELETE y la funcion eliminarUsuario del AdminController
        //Delete se utiliza para eliminar recursos existentes, en este caso, para eliminar un usuario específico identificado por su ID.
        Route::delete('/adminusuarios/{id}', 'eliminarUsuario')
            ->name('eliminarUsuario');
    });
// Rutas de inicio de sesión y registro
// Estas rutas no están protegidas por el middleware de autenticación, ya que son necesarias para que los usuarios
// puedan acceder a ellas para iniciar sesión o registrarse en la aplicación
Route::controller(LoginController::class)->group(function () {

    // Formulario login usuario
    Route::get('/login', 'cargarLogin')->name('login');

    // Formulario login admin
    Route::get('/loginAdmin', 'cargarLoginAdmin')->name('loginAdmin');

    // Registro
    Route::get('/registro', 'cargarRegistro')->name('registro');

    // Procesar login usuario
    Route::post('/loguear', 'loguear')->name('loguear');
    // Procesar login admin
    Route::post('/loguearAdmin', 'loguearAdmin')->name('loguearAdmin');
    // Procesar registro
    Route::post('/registrar', 'registrar')->name('registrar');

    // Cerrar sesión
    Route::post('/cerrar', 'cerrarSesion')->name('cerrar');
});
