<div class="card bg-light mb-3">
    <div class="card-header">

        <div class="row justify-content-between">
            <div class="col-auto mr-auto align-items-center">
                <small class="text-muted">
                    <a href="{{ $reply->owner->profileLink }}">{{ $reply->owner->name }}</a>
                    said
                    {{ $reply->created_at->diffForHumans() }}
                </small>
            </div>

            <div class="col-auto">

                @auth()
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
                @endauth()

                @guest()
                        <i class="fal fa-thumbs-up"></i>

                        {{ $reply->favorites_count }}
                @endguest

            </div>

        </div>
    </div>

    <div class="card-body">
        {{ $reply->body }}
    </div>
</div>