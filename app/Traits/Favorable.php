<?php


namespace App\Traits;


use App\Favorite;
use App\Reply;

trait Favorable
{

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
        return $this->favorites->where('user_id', auth()->id())->isNotEmpty();
    }
}