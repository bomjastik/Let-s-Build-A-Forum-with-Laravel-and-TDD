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

    <div class="card-footer">
        <a href="{{ $thread->creator->profileLink }}"><small>{{ $thread->creator->name }}</small></a>

        <small>{{ $thread->created_at->diffForHumans() }}</small>
    </div>
</div>