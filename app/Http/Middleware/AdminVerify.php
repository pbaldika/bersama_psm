<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->verified == 'verified')  {
            return $next($request);
          } else if (Auth::check() && Auth::user()->verified == 'request')  {
            return redirect()->back()->with('message', 'Mohon Tunggu Hingga Verifikasi Selesai! Akun Anda Masih Dalam Proses Verifikasi');
          }
        return $next($request);
    }
}
