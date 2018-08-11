@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @include('threads.list_item')

                @if ($replies && $replies->isNotEmpty())
                    @foreach($replies as $reply)
                        @include('threads.reply')
                    @endforeach

                    <div class="mt-5">
                        {{ $replies->links() }}
                    </div>
                @endif

                <div class="mt-5">
                    @auth()
                        <form method="POST" action="{{ route('threads.replies.store', $thread->slug) }}"
                              id="reply-form">
                            @csrf

                            <div class="form-group">
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

                            <button type="submit" class="btn btn-primary" id="submitReply">Post</button>
                        </form>
                    @endauth

                    @guest()
                        <div class="alert alert-light text-center" role="alert" id="login-alert">
                            Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.
                        </div>
                    @endguest
                </div>

            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }}
                        by <a href="{{ $thread->creator->profileLink }}">{{ $thread->creator->name }}</a>,
                        and currently
                        has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
