<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Email;

class EmailController extends Controller
{
    public function showEmails(Request $request)
    {
        $emails = Email::with(['sender', 'receivers'])->latest()->paginate(10);
        return view('email.index', compact('emails'));
    }
}
