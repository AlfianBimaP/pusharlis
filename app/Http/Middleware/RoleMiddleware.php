<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have access to this page');
    }
}
