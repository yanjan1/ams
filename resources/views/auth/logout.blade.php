@extends('layouts.app')
@section('title', $title)
@section('content')
<section class="logout-form">
    <div class="container">
        <div class="col-5">
            <div class="card">
                <div class="card-body">
                    Are you sure you want to logout ?
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn-danger btn">Logout</button>
                        <button class="btn-secondary btn" onclick="window.reload('/')">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection