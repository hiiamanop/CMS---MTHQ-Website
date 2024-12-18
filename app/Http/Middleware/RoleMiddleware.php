<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek jika user sudah login dan role_id sesuai
        if (Auth::check() && (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)) {
            return $next($request);
        }

        // Jika tidak sesuai, redirect ke halaman login dengan pesan error
        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
