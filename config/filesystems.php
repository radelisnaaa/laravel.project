<?php

return [
    'default' => env('FILESYSTEM_DISK', 'local'),

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => env('APP_STORAGE_PATH', storage_path('app')),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => env('APP_STORAGE_PATH', storage_path('app/public')),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        // Tambahkan konfigurasi Files.io sebagai disk baru
        'filesio' => [
            'driver' => 's3',
            'key' => env('FILESIO_KEY'),
            'secret' => env('FILESIO_SECRET'),
            'region' => env('FILESIO_REGION', 'global'),
            'bucket' => env('FILESIO_BUCKET'),
            'endpoint' => env('FILESIO_ENDPOINT', 'https://files.io'),
            'url' => env('FILESIO_URL'),
            'use_path_style_endpoint' => true,
            'throw' => false,
        ],
    ],

    'links' => [
        public_path('storage') => env('APP_STORAGE_PATH', storage_path('app/public')),
    ],
];