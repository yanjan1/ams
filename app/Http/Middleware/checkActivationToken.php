<?php

namespace App\Http\Middleware;

use App\Models\otp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkActivationToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('activation_token')){
            $token = session('activation_token');
            $cotp = otp::where(['token' => $token])->first();

            if($cotp && ($cotp->is_verified || now()->greaterThan($cotp->expires_at))){
                session()->forget('activation_token');
                return redirect()->route('login');
            }else{
                return $next($request);
            }

        }else{
            return redirect()->route('login');
        }
        
    }
}
