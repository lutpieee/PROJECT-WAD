<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Jika bukan admin, tendang balik ke home atau kasih error 403
            return redirect()->route('user.home')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
        }
        
        return $next($request);
    }
}
