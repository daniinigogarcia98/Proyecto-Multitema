<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UsuariosMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Registrar el middleware personalizado 'admin' para proteger las rutas de administración
        // El middleware AdminMiddleware se encargará de verificar si el usuario autenticado tiene el rol de administrador
        // Si el usuario no es un administrador, el middleware abortará la solicitud con un error 403 Acceso no autorizado
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'usuario' => UsuariosMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
