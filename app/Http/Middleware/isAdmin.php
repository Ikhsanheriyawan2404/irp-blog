<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class isAdmin
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
        if (auth()->user() && auth()->user()->role == 'admin') {
            return $next($request);
        }

        return redirect()->route('home')->with('danger' ,'Stop! Anda tidak punya izin akses!');
    }
}
