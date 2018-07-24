@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        Create a New Thread
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('threads.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}"
                                       class="form-control @if ($errors->has('title')) is-invalid @endif">
                                @if ($errors->has('title'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="channel_id">Channel:</label>
                                <select name="channel_id" id="channel_id"
                                        class="form-control @if ($errors->has('channel_id')) is-invalid @endif">
                                    <option value="">Select Channel</option>
                                    @if ($channels->isNotEmpty())
                                        @foreach($channels as $channel)
                                            <option value="{{ $channel->id }}">
                                                {{ $channel->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('channel_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('channel_id') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" id="body" rows="3"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
