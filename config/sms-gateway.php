<?php

return [

    'default' => env('SMS_DRIVER', 'kaveNegar'),

    'drivers' => [

        'kaveNegar' => [
            'adapter' => \App\Support\SmsGateway\Drivers\KaveNegar::class,
            'uri' => 'https://api.kavenegar.com/v1/',
            'credentials' => [
                'api-key' => env('SMS_KAVE_NEGAR_API_KEY'),
                'from' => env('SMS_KAVE_NEGAR_FROM')
            ]
        ],

        'ghasedak' => [
            'adapter' => \App\Support\SmsGateway\Drivers\Ghasedak::class,
            'uri' => 'http://api.iransmsservice.com/v2/',
            'credentials' => [
                'api-key' => env('SMS_GHASEDAK_API_KEY'),
                'from' => env('SMS_GHASEDAK_FROM')
            ]
        ]
    ],

];
