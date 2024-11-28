<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $role = auth()->user()->role;
    
            if ($role === 'admin') {
                return $next($request);
            }
        }
    
        abort(403, 'Your are not allowed to access this page');
    }
}
