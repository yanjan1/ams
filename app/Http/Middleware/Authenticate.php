<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        }
        return redirect()->route('login', ['title' => 'AMS | Login']);
    }
}
