@extends('layouts.app')
@section('title', $title)
@section('content')
    <div class="container d-flex justify-content-center my-5">
        <div class="card col-sm-5">
            <div class="card-body">
                <div class="card-title text-center">
                    <h4>Forgot Password</h4>
                    </div>
                <form method="POST" action="{{ route('forgot-password.submit') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="mb-2">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required autofocus>
                    </div>
                    {{-- show error --}}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <button type="submit" class="btn btn-primary mt-3 w-100">GET OTP</button>
                </form>
            </div>
        </div>
    </div>
@endsection