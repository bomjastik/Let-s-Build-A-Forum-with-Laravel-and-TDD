<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body', 'user_id',];

    /**
     * Get the thread for the reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * Get the owner for the reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the reply's favorites
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    /**
     * Favorite the reply.
     *
     * @param int|null $userId
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function favorite(int $userId = null)
    {
        $attributes = ['user_id' => $userId ?: auth()->id()];

        if ($this->favorites()->where($attributes)->exists()) {
            return $this;
        }

        return $this->favorites()->create($attributes);
    }

    /**
     * Check if reply is favorited.
     *
     * @return bool
     */
    public function isFavorited(): bool
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
}
