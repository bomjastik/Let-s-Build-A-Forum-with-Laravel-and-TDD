@foreach($threads as $thread)
    @include('threads.list_item')
@endforeach

@forelse($threads as $thread)
    @include('threads.list_item')
@empty
    <div class="alert alert-warning" role="alert">
        There are no relevant results at this time.
    </div>
@endforelse

<div class="mt-5">
    {{ $threads->links() }}
</div>