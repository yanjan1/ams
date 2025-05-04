{{-- create a table renderinga all --}}

@extends('layouts.app')
@section('content')
<section class="mt-5">
    <div class="container">
        <h2 class="mb-4">Emails</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Sender</th>
                    <th>Receipient</th>
                    <th>Subject</th>
                    <th>Body</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach ($emails as $email)
                    <tr>
                        <td>{{ $email->id }}</td>
                        <td>
                            {{ $email->sender->owner_name }}
                            <a href="mailto:{{ $email->sender->email }}">{{ $email->sender->email }}</a><br/>
                        </td>
                        <td>
                            @foreach ($email->receivers as $recipient)
                                {{ $recipient->owner_name }}
                                <a href="mailto:{{ $recipient->email }}">{{ $recipient->email }}</a><br/><br/>
                            @endforeach
                        </td>
                        <td>{{ $email->subject }}</td>
                        <td>{{ $email->body }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection