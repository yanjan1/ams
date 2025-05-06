<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailId;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\otp;
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

        if (Auth::attempt(
            $credentials,
            $remember
        ) && Auth::user()->login_allow) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
        }
    }


    public function sendOTPAndVerify(Request $req)
    {
       return view('auth.verifyActiationOtp', ['title' => 'Verify The token']);
    }

    public function activationOTPCheck(Request $req)
    {
      
    }


    public function getLogout(Request $request)
    {
        return view('auth.logout', ['title' => 'AMS | Logout']);
    }

    public function logout(Request $request)
    {
        if (!$request->isMethod('post')) {
            abort(405);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
