<?php

return new ptejada\uFlex\Collection([
    'cookieTime'      => '30',
    'cookieName'      => 'auto',
    'cookiePath'      => '/',
    'cookieHost'      => false,
    'userTableName'   => 'Users',
    'userSession'     => 'userData',
    'userDefaultData' => [
        'Username' => 'Guess',
        'ID'  => 0,
        'Password' => 0,
    ],
    'database' => [
        'host'     => 'localhost',
        'name'     => '',
        'user'     => '',
        'password' => '',
        'dsn'      => '',
        'pdo'      => '',
    ]
]);