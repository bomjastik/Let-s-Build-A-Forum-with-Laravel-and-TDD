<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function url()
    {
        return route('threads.show', $this->id);
    }
}
