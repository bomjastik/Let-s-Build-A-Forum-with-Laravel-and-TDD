<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Http\Requests\StoreThreadRequest;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the threads.
     *
     * @param Channel|null $channel
     * @return mixed
     */
    public function index(Channel $channel = null)
    {
        $threads = Thread::with('channel', 'creator')->latest();

        if ($channel) {
            $threads->whereChannelId($channel->id);
        }

        if ($username = request('by')) {
            $user = User::where('name', $username)->firstOrFail();

            $threads->whereUserId($user->id);
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
        return view('threads.show', compact('thread', 'channel'));
    }
}
