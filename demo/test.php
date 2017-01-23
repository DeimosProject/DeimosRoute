<?php

include_once dirname(__DIR__) . '/vendor/autoload.php';

$route = new \Deimos\Route\Route(['/hello']);

var_dump($route);

$route = new \Deimos\Route\Route(
    ['/hello(/<prefix:\w+>)'],
    [
        'controller' => 'first',
        'prefix'     => 'admin',
    ]
);

var_dump($route);

$route = new \Deimos\Route\Route(
    ['/hello(/<controller:\w+>)'],
    [
        'controller' => 'first',
        'prefix'     => 'admin',
    ],
    ['POST', 'GET']
);

var_dump($route);
