<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        if (Auth::user()->role !== 'user') {
            return redirect('/')->with('error', 'Akses hanya untuk user.');
        }

        return $next($request);
    }
}
