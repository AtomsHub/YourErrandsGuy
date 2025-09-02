<?php

return [
        'defaults' => [
    'guard' => 'web',  // default
    'passwords' => 'users',
],

'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'admin' => [
        'driver' => 'session',
        'provider' => 'admins',
    ],

    'vendor' => [
        'driver' => 'session',
        'provider' => 'vendors',
    ],

    'dispatcher' => [
        'driver' => 'session',
        'provider' => 'dispatchers',
    ],

    // Sanctum guard (important if you use API tokens)
    'api' => [
        'driver' => 'sanctum',
        'provider' => null,
    ],
],

'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => App\Models\User::class,
    ],
    'admins' => [
        'driver' => 'eloquent',
        'model' => App\Models\Admin::class,
    ],
    'vendors' => [
        'driver' => 'eloquent',
        'model' => App\Models\Vendor::class,
    ],
    'dispatchers' => [
        'driver' => 'eloquent',
        'model' => App\Models\Dispatcher::class,
    ],
],


];
