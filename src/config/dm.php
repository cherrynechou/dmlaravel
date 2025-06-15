<?php

return [
    'dm' => [
        'driver'         => 'dm',
        'host'           => env('DB_HOST', 'localhost'),
        'port'           => env('DB_PORT', '5236'),
        'database'       => env('DB_DATABASE', ''),
        'schema'         => env('DB_SCHEMA', ''),
        'username'       => env('DB_USERNAME', ''),
        'password'       => env('DB_PASSWORD', ''),
        'charset'        => env('DB_CHARSET', 'UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
    ],
];
