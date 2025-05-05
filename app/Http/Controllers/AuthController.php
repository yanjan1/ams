<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\otp;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', ['title' => 'AMS | Login']);
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgotpass', ['title' => "AMS | Reset Password"]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the user exists
        $user = User::where('email', $credentials['email'])->first();
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'User not found'])->withInput();
        }

        // check if login is allowed
        if ($user->is_login_allowed == 0) {
            return redirect()->back()->withErrors(['error' => 'Login is not allowed for this user.'])->withInput();
        }

        if (Auth::attempt(
            $credentials,
            $remember
        )) {
            $user = Auth::user();

            if (!$user->active) {
                $token = bin2hex(random_bytes(8));
                otp::create(
                    [
                        'user_id' => $user->id,
                        'otp' => Str::random(8),
                        'token' => $token,
                        'is_verified' => false,
                        'purpose' => otp::PURPOSE_ACTIVATE_ACCOUNT
                    ]
                );
                
                session(['token', $token]);
                return redirect().route('activation_otp_verify');
            }
            else{
                return redirect().route('dashboard');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
}
