@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mb-3">
                    <div class="card-header">
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>

                    <div class="card-footer">
                        <small class="text-muted">
                            <a href="">
                                {{ $thread->creator->name }}
                            </a>
                            posted
                            {{ $thread->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>

                @if ($thread->replies && $thread->replies->isNotEmpty())
                    @foreach($thread->replies as $reply)
                        @include('threads.reply')
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
