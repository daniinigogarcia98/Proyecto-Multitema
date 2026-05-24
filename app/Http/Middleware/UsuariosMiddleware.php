<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsuariosMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $us = $request->user();

        // Verificar si el usuario no está autenticado o si su rol no es de usuario normal
        // Si el usuario no es un usuario normal, se aborta la solicitud con un error 403 Acceso no autorizado.
        if (!$us || $us->rol !== 'U') {
            abort(403 ,'Pagina no Disponible');
        }

        return $next($request);
    }
}
