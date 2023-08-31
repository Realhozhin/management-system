<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()->role_as == 'admin') {
            return redirect('/')->with('message','you`re not admin');
        }
        if (!Auth::user()->role_as == 'producer') {
            return redirect('/')->with('message','you`re not producer');
        }
        return $next($request);
    }
}
