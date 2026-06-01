<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        $role = strtolower(trim((string) $user?->tipo));

        if (! $user || ! in_array($role, $roles, true)) {
            abort(403, 'Voce nao tem permissao para acessar esta area.');
        }

        return $next($request);
    }
}
