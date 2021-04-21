<?php
return [

    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'sigmail.ufpi.br'),
    'port' => env('MAIL_PORT', 25),
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'equipac.ufpi@gmail.com'),
        'name' => env('MAIL_FROM_NAME', 'Equipac'),
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '\"C:\xampp\sendmail\sendmail.exe\" -t',

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
];
