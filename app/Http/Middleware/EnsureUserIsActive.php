<?php

namespace App\Http\Middleware;

use App\Models\Email;
use App\Models\EmailId;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\otp;


class EnsureUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()){
            if(Auth::user()->active){
                return $next($request);
            }else{
                $newotp = otp::create([
                    'user_id' => Auth::id(),
                    'otp' => Str::upper(Str::random(10)),
                    'created_at' => now(),
                    'expires_at' => now()->addMinutes(10),
                    'token' => Str::uuid(),
                    'purpose' => otp::PURPOSE_ACTIVATE_ACCOUNT,
                    'tries' => 0,
                    'is_verified' => false,
                ]);
                
                $mymail = env('EMAIL_SENDER_ADDRESS');
              
                $senderEmail = EmailId::firstOrCreate([
                    'owner_name' => 'AMS Admin',
                    'email' => $mymail
                ]);

                $recipientEmail = EmailId::updateOrCreate(
                    ['email' => Auth::user()->email],
                    ['owner_name' => Auth::user()->email],
                );

                $em1 = Email::create([
                    'sender_id' => $senderEmail->id,
                    'subject' => 'Activate your account',
                    'body' => 'Your activation code is ' . $newotp->otp
                ]);

                $em1->receivers()->attach($recipientEmail->id);

                session(['activation_token' => $newotp->token]);

                return redirect()->route('activation-otp-form');
            }
        }else{
            return redirect('login');
        }
    }
}
