@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>
            {{ $profileUser->name }}
            <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
        </h2>

        <hr>

        <h3>User threads</h3>

        @include('threads.list')

    </div>
@endsection
