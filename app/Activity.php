<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'subject_id',
        'subject_type',
    ];

    /**
     * Get all of the owning subject models.
     */
    public function subject()
    {
        return $this->morphTo();
    }
}
