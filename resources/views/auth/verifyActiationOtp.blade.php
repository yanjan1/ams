@extends('layouts.app')
@section('title', $title)
@section('content')
    <section>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>OTP Verification</h4>
                    </div>
                    <div class="card-body">
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
        
                            <input type="hidden" name="token" value="{{ session('token') }}">
        
                            <button type="submit" class="btn btn-primary w-100">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection