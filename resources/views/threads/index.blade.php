@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @foreach($threads as $thread)

                    <div class="card mb-3">
                        <div class="card-header">

                            <div class="row justify-content-between">
                                <div class="col-6">
                                    <a href="{{ $thread->url }}">
                                        {{ $thread->title }}
                                    </a>
                                </div>
                                <div class="col-4 text-right">
                                    <a href="{{ $thread->url }}"
                                       title="{{ str_plural('reply', $thread->replies_count) }}">
                                        <i class="fal fa-comments"></i> {{ $thread->replies_count }}
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="card-body">
                            {{ $thread->body }}
                        </div>
                    </div>

                @endforeach

                <div class="mt-5">
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
