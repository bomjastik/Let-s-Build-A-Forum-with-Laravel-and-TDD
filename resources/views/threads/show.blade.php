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

        <div class="row mt-5">
            <div class="col-md-12">
                @auth()
                    <form method="POST" action="{{ route('threads.replies.store', $thread->slug) }}" id="reply-form">
                        @csrf

                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea name="body" id="body" rows="3" placeholder="Have something to say?"
                                      class="form-control @if ($errors->has('body')) is-invalid @endif">
                                {{ old('body') }}
                            </textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('body') }}
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </form>
                @endauth

                @guest()
                    <div class="alert alert-light text-center" role="alert" id="login-alert">
                        Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
                    </div>
                @endguest
            </div>
        </div>
    </div>
@endsection
