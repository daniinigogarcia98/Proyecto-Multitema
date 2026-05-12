<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   return redirect()->route('inicio');
});
Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::controller(LoginController::class)->group(function(){
    Route::get('/login','cargarLogin')->name('login');
    Route::get('/registro','cargarRegistro')->name('registro');
    Route::post('/loguear','loguear')->name('loguear');
    Route::post('/registrar','registrar')->name('registrar');
    Route::post('/cerrar','cerrarSesion')->name('cerrar');
});
