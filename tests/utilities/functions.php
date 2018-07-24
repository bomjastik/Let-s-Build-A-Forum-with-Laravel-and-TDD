<?php


function create($entity, array $attributes = [])
{
    return factory(getEntityClass($entity))->create($attributes);
}

function make($entity, array $attributes = [])
{
    return factory(getEntityClass($entity))->make($attributes);
}

function raw($entity, array $attributes = [])
{
    return factory(getEntityClass($entity))->raw($attributes);
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