<?php


namespace App\Filters;


use App\User;

class ThreadFilters extends Filters
{
    /**
     * Allowed filters.
     *
     * @var array
     */
    protected $filters = ['by', 'popular'];

    /**
     * Filter the query by a given username.
     *
     * @param string $username
     * @return mixed
     */
    protected function by(string $username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->whereUserId($user->id);
    }

    /**
     * Filter the query according to most popular threads.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function popular()
    {
        $this->builder->getQuery()->orders = [];

        return $this->builder->orderBy('replies_count', 'desc');
    }
}