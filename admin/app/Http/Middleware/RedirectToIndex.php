<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectToIndex
{
    public function handle(Request $request, Closure $next)
    {
        // Redirect to /index if trying to access any of the following routes
        $blockedRoutes = ['/profile', '/home', '/list_menu', '/list_truck', '/local_truck', '/list_product'];
        
        if (in_array($request->path(), $blockedRoutes)) {
            return redirect()->route('index');
        }

        return $next($request);
    }
}

