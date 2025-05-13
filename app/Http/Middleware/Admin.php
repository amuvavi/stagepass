<?php

namespace App\Http\Middleware;

use App\Services\UserRoleService;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !UserRoleService::isAdmin(auth()->user())) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
