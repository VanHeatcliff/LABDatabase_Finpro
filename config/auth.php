<?php

return [

    'defaults' => [
        'guard' => 'pelanggan',
        'passwords' => 'pelanggan',
    ],

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admin',
        ],

        'pelanggan' => [
            'driver' => 'session',
            'provider' => 'pelanggan',
        ],
    ],

    'providers' => [
        'admin' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        'pelanggan' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pelanggan::class,
        ],
    ],

    'passwords' => [
        'admin' => [
            'provider' => 'admin',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'pelanggan' => [
            'provider' => 'pelanggan',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
