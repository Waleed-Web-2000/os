<?php

return [
    'enabled' => env('PAGE_SPEED_ENABLED', true),

    'html' => [
        'enable' => true,
        'minify' => true,
    ],

    'css' => [
        'enable' => true,
        'minify' => true,
    ],

    'js' => [
        'enable' => true,
        'minify' => true,
    ],

    'images' => [
        'enable' => true,
    ],

    'cache' => [
        'enable' => true,
        'max_age' => 86400,
    ],

    'gzip' => [
        'enable' => true,
    ],
];
