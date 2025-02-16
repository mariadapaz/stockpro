<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    public function handle(Request $request, Closure $next, string ...$types): Response
    {
        if (!auth()->check()) {
            abort(403, 'Acesso negado');
        }

        $user = auth()->user();

        // Verifica se o tipo do usuário está na lista permitida
        if (in_array($user->type, $types)) {
            return $next($request);
        }

        abort(403, 'Acesso negado');
    }
}
