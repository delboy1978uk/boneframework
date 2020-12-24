<?php

return [
    'log' => [
        'channels' => [
            'default' => 'data/logs/default_log',
        ],
    ],
    'error_log' => '/proc/self/fd/2',
    'error_reporting' => -1,
    'display_errors' => true,
];

error_log('HELLO');