<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictError404Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si la solicitud proviene de una redirección interna
        if (!$request->headers->has('referer')) {
            // Devolver un error 403 (Prohibido) con una vista personalizada
            return response()->view('layout.alerts.error403', [], 403);
        }

        return $next($request);
    }
}
