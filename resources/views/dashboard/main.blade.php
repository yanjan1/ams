@extends('layouts.app')
@section('content')
    <h1>{{ $user->email }}</h1>
    <ul>
        @foreach ($user->roles as $role)
            <li>{{ $role->name }}</li>
        @endforeach
    </ul>
    
@endsection