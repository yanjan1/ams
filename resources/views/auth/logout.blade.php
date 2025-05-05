@extends('layouts.app')
@section('title', $title)
@section('content')
<section class="logout-form mt-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-3">Are you sure you want to logout ?</h4>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="btn-danger btn">Logout</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Return to Home</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection