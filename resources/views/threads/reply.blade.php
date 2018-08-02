<div class="card bg-light mb-3">
    <div class="card-header">

        <div class="row">
            <div class="col-auto mr-auto">
                <small class="text-muted">
                    <a href="">
                        {{ $reply->owner->name }}
                    </a>
                    said
                    {{ $reply->created_at->diffForHumans() }}
                </small>
            </div>
            @auth()
                <div class="col-auto">
                    <form method="POST" action="{{ route('replies.favorites', $reply->id) }}">
                        @csrf

                        <button type="submit" class="btn btn-link">
                            @if ($reply->isFavorited())
                                <strong><i class="fas fa-thumbs-up"></i></strong>
                            @else
                                <i class="fal fa-thumbs-up"></i>
                            @endif
                            
                            {{ $reply->favorites_count }}
                        </button>
                    </form>
                </div>
            @endauth()
        </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>