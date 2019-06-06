<?php

/**
 *  We be feckin' around with t'configuration
 */
return [
    'routes' => [
        '/' => [
            'controller' => 'index',
            'action' => 'index',
            'params' => [],
        ],
        '/:locale' => [
            'controller' => 'index',
            'action' => 'index',
            'params' => [],
        ],
        '/:locale/learn' => [
            'controller' => 'index',
            'action' => 'learn',
            'params' => [],
        ],
        '/optional[/:id]' => [
            'controller' => 'index',
            'action' => 'index',
            'params' => [],
        ],
        '/both/:mandatory/:and[/:optional]' => [
            'controller' => 'index',
            'action' => 'index',
            'params' => [],
        ],
    ],
];