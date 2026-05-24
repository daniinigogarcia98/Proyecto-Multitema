<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener el usuario autenticado
            $us = $request->user();

        // Verificar si el usuario no está autenticado o si su rol no es de administrador
        // Si el usuario no es un administrador, se aborta la solicitud con un error 403 Acceso no autorizado.
        if (!$us || $us->rol === 'U') {
            abort(403, 'Acceso no autorizado - Solo administradores pueden acceder a esta sección');
        }



        return $next($request);
    }
}
