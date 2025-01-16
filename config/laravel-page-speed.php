<?php
return [
    'enabled' => env('PAGE_SPEED_ENABLED', true),

    'html' => [
        'enable' => true,
        'minify' => false,  // Enable or disable HTML minification
    ],

    'css' => [
        'enable' => true,
        'minify' => false,  // Enable or disable CSS minification
    ],

    'js' => [
        'enable' => true,
        'minify' => false,  // Enable or disable JS minification
    ],

    'images' => [
        'enable' => false,  // Optimize images if necessary
    ],

    'gzip' => [
        'enable' => true,  // Enable GZIP compression
    ],

    'cache' => [
        'enable' => true,  // Enable caching for static assets
        'max_age' => 86400,
    ],
];
