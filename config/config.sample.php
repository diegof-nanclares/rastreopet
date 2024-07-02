<?php

session_start();
return [
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'findpetsmart',
    ],
    'session' => [
        'name' => 'myapp_session',
        'lifetime' => 3600,
        'path' => '/',
        'domain' => null,
        'secure' => false,
        'httponly' => true,
    ],
    'environment' => 'development',
];

