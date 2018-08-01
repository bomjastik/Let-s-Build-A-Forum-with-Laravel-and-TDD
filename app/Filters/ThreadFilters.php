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
    protected $filters = ['by'];

    /**
     * Filter by username.
     *
     * @param string $username
     * @return mixed
     */
    protected function by(string $username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->whereUserId($user->id);
    }
}