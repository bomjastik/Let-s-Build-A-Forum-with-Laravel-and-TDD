@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                @foreach($threads as $thread)

                <div class="card mb-3">
                    <div class="card-header">
                        <a href="{{ $thread->url() }}">
                            {{ $thread->title }}
                        </a>
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
