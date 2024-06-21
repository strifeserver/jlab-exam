<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'accounts',
        ],

        'api' => [
            'driver' => 'sanctum',
            'provider' => 'accounts',
            'hash' => false,
        ],

        'accounts' => [
            'driver' => 'sanctum',
            'provider' => 'accounts',
            'hash' => false,
        ],

        'customers' => [
            'driver' => 'sanctum',
            'provider' => 'customers',
            'hash' => false,
        ],
    ],

    'providers' => [
        'accounts' => [
            'driver' => 'eloquent',
            'model' => Modules\System\Entities\Account::class,
        ],

        'customers' => [
            'driver' => 'eloquent',
            'model' => Modules\System\Entities\Customer::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
