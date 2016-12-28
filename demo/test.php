<?php

include_once __DIR__ . '/../vendor/autoload.php';

$route = new \Deimos\Route\Route(['/hello']);

var_dump($route);

$route = new \Deimos\Route\Route([
    '/hello', [
        'controller' => 'first',
        'prefix'     => 'admin',
    ]
]);

var_dump($route);

$route = new \Deimos\Route\Route([
    '/hello', [
        'controller' => 'first',
        'prefix'     => 'admin',
    ], ['POST', 'GET']
]);

var_dump($route);
