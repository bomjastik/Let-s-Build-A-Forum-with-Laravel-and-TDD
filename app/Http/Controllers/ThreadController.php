<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadFilters;
use App\Http\Requests\StoreThreadRequest;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the threads.
     *
     * @param Channel $channel
     * @param ThreadFilters $filters
     * @return mixed
     */
    public function index(Channel $channel, ThreadFilters $filters)
    {
        $threads = $this->getThreads($channel, $filters);

        if (request()->wantsJson()) {
            return $threads->get();
        }

        return view('threads.index')
            ->withThreads($threads->paginate(10));
    }

    /**
     * Show the form for creating a new thread.
     *
     * @return mixed
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created thread.
     *
     * @param StoreThreadRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreThreadRequest $request)
    {
        $thread = new Thread([
            'user_id' => auth()->id(),
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'body' => trim($request->body),
        ]);

        $thread->save();

        return redirect($thread->url());
    }

    /**
     * Display the specified thread.
     *
     * @param Channel $channel
     * @param Thread $thread
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Channel $channel, Thread $thread)
    {
        return view('threads.show')->with([
            'thread' => $thread,
            'replies' => $thread->replies()->paginate(10),
        ]);
    }

    /**
     * Fetch all relevant threads.
     *
     * @param \App\Channel $channel
     * @param \App\Filters\ThreadFilters $filters
     * @return mixed
     */
    protected function getThreads(Channel $channel, ThreadFilters $filters)
    {
        $threads = Thread::with('channel')
            ->latest()
            ->filter($filters);

        if ($channel->exists) {
            $threads->whereChannelId($channel->id);
        }

        return $threads;
    }
}
