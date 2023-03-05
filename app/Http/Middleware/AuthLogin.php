<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        foreach ($roles as $r) {
            if (Auth::guard($r)->user()) {
                return $next($request);
            }
        }

        return redirect()->route('login')->with(['jenis' => 'danger', 'pesan' => 'Anda belum login']);
    }
}
