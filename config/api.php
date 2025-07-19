<?php

return [
    'url' => env('API_URL', 'http://localhost:8001'),
    'secret' => env('API_SECRET', 'aKndsan23928h98hKJbkjwlKHD9dsbjwiobqUJGHBDWHvkHSJQUBSQOPSAJHVwoihdapq'),
    'device' => env('API_DEVICE', 'web'),
    'timeout' => env('API_TIMEOUT', 30),

    'endpoints' => [
        'provinsi' => '/v1/wilayah/provinsi',
        'kab_kota' => '/v1/wilayah/kab-kota',
        'kecamatan' => '/v1/wilayah/kecamatan',
        'kelurahan' => '/v1/wilayah/kelurahan',
        'register' => '/v1/affiliator/register',
    ],
];
