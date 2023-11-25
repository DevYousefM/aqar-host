<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth("admin")->user()) {
            return $next($request);
        } else {
            return redirect()->route("admin.login");
        }
    }
}
