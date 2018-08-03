<div class="card mb-3">
    <div class="card-header">
        <div class="row justify-content-between">
            <div class="col-auto mr-auto">
                <a href="{{ $thread->url }}">
                    {{ $thread->title }}
                </a>
            </div>
            <div class="col-auto">
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

    <div class="card-footer">

        <div class="row justify-content-between">
            <div class="col-auto mr-auto">
                <a href="{{ $thread->creator->profileLink }}">
                    <small>{{ $thread->creator->name }}</small>
                </a>

                <small>{{ $thread->created_at->diffForHumans() }}</small>
            </div>

            @can('forceDelete', $thread)
                <div class="col-auto">
                    <form method="POST" action="{{ route('threads.destroy', $thread->slug) }}">
                        @csrf
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger" id="submit">
                            <i class="fal fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endcan

        </div>

    </div>
</div>