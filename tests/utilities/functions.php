<?php


function create($entity, array $attributes = [], $count = null)
{
    return factory(getEntityClass($entity), $count)->create($attributes);
}

function make($entity, array $attributes = [], $count = null)
{
    return factory(getEntityClass($entity), $count)->make($attributes);
}

function raw($entity, array $attributes = [], $count = null)
{
    return factory(getEntityClass($entity), $count)->raw($attributes);
}

function getEntityClass(string $entity)
{
    $entities = [
        'thread' => 'App\Thread',
        'reply' => 'App\Reply',
        'user' => 'App\User',
        'channel' => 'App\Channel',
    ];

    return isset($entities[$entity]) ? $entities[$entity] : $entity;
}