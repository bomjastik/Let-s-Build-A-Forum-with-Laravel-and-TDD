@foreach($threads as $thread)
    @include('threads.list_item')
@endforeach

<div class="mt-5">
    {{ $threads->links() }}
</div>