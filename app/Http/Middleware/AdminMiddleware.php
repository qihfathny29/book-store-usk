<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   /**
     * Cek apakah user yang login adalah admin.
     * Jika bukan, redirect ke halaman utama.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('user') || session('user')['role'] !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
