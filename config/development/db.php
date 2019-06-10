<?php

ini_set('xdebug.var_display_max_depth', 10);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);

/**
 *  We be feckin' around with t'configuration
 */
return [
    'db' => [
        'driver' => 'pdo_mysql',
        'host' => 'mariadb',
        'database' => 'awesome',
        'dbname' => 'awesome',
        'user' => 'dbuser',
        'pass' => '[123456]',
        'password' => '[123456]',
    ],
];
