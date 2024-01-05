<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class CheckAccessToken
{
    public function handle($request, Closure $next)
    {
        if (Session::has('userToken')) {
            return $next($request);
        } else {
           return redirect()->route('login');
        }
    }
}
