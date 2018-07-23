<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Thread $thread, Request $request)
    {
        $thread->replies()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);

        return back();
    }
}
