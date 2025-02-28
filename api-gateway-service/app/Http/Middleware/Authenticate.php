<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;;

class Authenticate extends Middleware
{
    /**
     * Redirige al usuario cuando no está autenticado.
     */
    protected function redirectTo(Request $request)
    {
        if (!$request->expectsJson()) {
            abort(response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED));
        }
        // return $request->expectsJson() ? null : route('login');
    }

    /**
     * Handle an incoming request.
     */
    // public function handle($request, Closure $next, ...$guards)
    // {
    //     // Agrega lógica personalizada aquí
    //     if ($this->auth->guard($guards)->guest()) {
    //         // Ejemplo: Lanzar una excepción personalizada
    //         throw new \Illuminate\Auth\AuthenticationException('Acceso denegado. Debes iniciar sesión.');
    //     }

    //     return $next($request);
    // }
}
