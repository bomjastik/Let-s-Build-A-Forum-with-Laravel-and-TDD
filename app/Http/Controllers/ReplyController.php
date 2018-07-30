<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Thread;

class ReplyController extends Controller
{
    /**
     * Store a newly created reply for the thread.
     *
     * @param Thread $thread
     * @param StoreReplyRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Thread $thread, StoreReplyRequest $request)
    {
        $thread->replies()->create([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        return redirect($thread->url());
    }
}
