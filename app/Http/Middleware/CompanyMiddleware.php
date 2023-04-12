<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
     {
        if (Auth::check() && Auth::user()->role == 'company')  {
            return $next($request);
          } else{
            Auth::logout();
            return redirect()->route('login');
          }

        return $next($request);
    }
}
