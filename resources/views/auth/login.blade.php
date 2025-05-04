@extends('layouts.app')
@section('title', $title)
@section('content')
<section class="login-form my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 bg-light p-2 rounded">
                {{-- login form --}}
                <div class="card">
                    <div class="card-header text-center">
                        <h4 class="my-3">Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.submit') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="email" class="mb-2">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="mb-2">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="form-group form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        {{-- error message --}}
                        @if (session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
                        {{-- forgot password link --}}
                        <div class="text-center mt-3">
                            <a href="/forgot-password" class="text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection