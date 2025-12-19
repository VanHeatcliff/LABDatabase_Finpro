<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login dan role = admin
        if (auth()->guard('admin')->check()) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Harus login sebagai admin.');
    }
}
