<?php

namespace App;

use App\Filters\ThreadFilters;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'body', 'user_id', 'channel_id',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['creator', 'channel'];

    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = ['replies'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies()->delete();
        });
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the replies for the thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Get the creator of the thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the channel for the thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * Get thread url.
     *
     * @return string
     */
    public function url(): string
    {
        return route('threads.show', [$this->channel->slug, $this->slug]);
    }

    /**
     * Get thread url.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('threads.show', [$this->channel->slug, $this->slug]);
    }

    /**
     * Scope a query to filter threads.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\ThreadFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }
}
