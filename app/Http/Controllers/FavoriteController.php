<?php

namespace App\Http\Controllers;

use App\Reply;

class FavoriteController extends Controller
{
    /**
     * Favorite the reply.
     *
     * @param \App\Reply $reply
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Reply $reply)
    {
        return $reply->favorite();
    }
}
