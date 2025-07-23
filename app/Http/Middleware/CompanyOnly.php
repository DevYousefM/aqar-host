<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()) {
            if (auth()->user()->account_type === "company") {
                return $next($request);
            } else {
                abort(403);
            }
        } else return redirect()->route("login");
    }
}
