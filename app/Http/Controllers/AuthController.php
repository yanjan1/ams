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
                $newotp = otp::create(
                    [
                        'user_id' => $user->id,
                        'otp' => Str::upper(Str::random(10)),
                        'token' => bin2hex(random_bytes(8)),
                        'is_verified' => false,
                        'purpose' => otp::PURPOSE_ACTIVATE_ACCOUNT
                    ]
                );

                $sender = EmailId::create([
                    'email' => env('EMAIL_SENDER_ADDRESS'),
                    'owner_name' => 'AMS Admin',
                ]);

                $recipient = EmailId::create([
                    'email' => $user->email,
                    'owner_name' => "",
                ]);

                $email = Email::create([
                    'sender_id' => $sender->id,
                    'subject' => 'Account activation mail',
                    'body' => 'Your otp for account activation is ' . $newotp->otp
                ]);

                $email->receivers()->attach([$recipient->id]);

                session(['token' => $newotp->token]);
                return redirect() . route('activation-otp-verify');
            } else {
                return redirect() . route('dashboard');
            }
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }


    public function sendOTPAndVerify(Request $req)
    {
        $user = Auth::user();
        if ($user->active) {
            return redirect('dashboard');
        }
        // else if session has a valid token and its purpose is account activation only show the form 
        $sessionToken = session('token');
        if ($sessionToken) {
            $otp_check = otp::where('token', $sessionToken)
                ->where('user_id', $user->id)
                ->where('purpose', otp::PURPOSE_ACTIVATE_ACCOUNT)
                ->where('is_verified', false)
                ->first();
            if ($otp_check && $otp_check->tries < 4) {
                return view('auth.verifyActiationOtp');
            }
        }

        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('login')->withErrors(['otp' => 'Session expired. Please login again.']);

        // otherwise redirect to login 
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
