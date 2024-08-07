<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CekSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $login = Session::get('login');
        if ($login) {
            Session::get('user_session');
        } else {
            // Toastr::success('Kamu Keluar', 'Berhasil');
            return redirect()->route('login')->with('failed', 'Kamu belum login!');
        }
        return $next($request);
    }
}
