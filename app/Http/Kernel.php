<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\EnsureUserIsActive;
use App\Http\Middleware\checkActivationToken;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'activation' => EnsureUserIsActive::class,
        'tokenExists' => checkActivationToken::class
    ];
}