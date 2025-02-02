<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y si su COD_CARGO es 4
        if (Auth::check() && Auth::user()->cod_cargo == 4) {
            return $next($request);
        }

        // Si no es administrador, redirige al usuario a donde consideres apropiado
        return redirect()->route('error404');
    }
}
