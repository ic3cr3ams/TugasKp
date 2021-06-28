<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KajurStatus
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
        if (Auth::user()== null || Auth::user()->IsDekan("") || Auth::user()->IsWarek("1") || Auth::user()->isDosen() && !Auth::user()->isKajur()){
            Auth::logout();
            return redirect('/')->with(["pesan"=>"Denied"]);
        }
        return $next($request);
    }
}
