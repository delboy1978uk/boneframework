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
        '/learn' => [
            'controller' => 'index',
            'action' => 'learn',
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
        '/swashbuckling/:id' => [
            'controller' => 'events',
            'action' => 'view',
            'params' => [
                'time' => time(),
                'mandatory_param_regex' => \Bone\Regex\Url::URL_MANDATORY_PARAM
            ],
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