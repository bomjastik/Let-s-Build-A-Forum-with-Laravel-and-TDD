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