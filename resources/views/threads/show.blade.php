@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card mb-3">
                    <div class="card-header">{{ $thread->title }}</div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                @if ($thread->replies && $thread->replies->isNotEmpty())
                    @foreach($thread->replies as $reply)
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                {{ $reply->body }}
                            </div>

                            <div class="card-footer">
                                <small class="text-muted">
                                    <a href="">
                                        {{ $reply->owner->name }}
                                    </a>
                                    said
                                    {{ $reply->created_at->diffForHumans() }}
                                </small>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
