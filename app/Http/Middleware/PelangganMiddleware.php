<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PelangganMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('pelanggan')->check()) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Harus login sebagai pelanggan.');
    }
}
