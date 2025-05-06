@extends('layouts.app')
@section('title', $title)
@section('content')
    <section class="my-5">
        <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4 class="my-3">OTP Verification</h4>
                    </div>
                    <div class="card-body">
                        <p>Your account is currently using the default password. To ensure security, please reset your password before accessing your account. <br/> An activation 
                            <b>OTP</b> has been sent to your email enter the OTP.
                        </p>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        
                        <form action="{{ route('otp-activation-verify') }}" method="POST">
                            @csrf
        
                            <div class="mb-3">
                                <label for="otp" class="form-label">Enter OTP</label>
                                <input type="text" name="otp" id="otp" class="form-control" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection