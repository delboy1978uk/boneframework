<?php

/**
 *  We be feckin' around with t'configuration
 */
return array(
    'routes' => array(
        '/' => array(
            'controller' => 'index',
            'action' => 'index',
            'params' => array(),
        ),
        '/error' => array(
            'controller' => 'error',
            'action' => 'index',
            'params' => array(),
        ),
        '/swashbuckling/:id' => array(
            'controller' => 'events',
            'action' => 'view',
            'params' => array(
                'time' => time(),
                'mandatory_param_regex' => \Bone\Regex\Url::URL_MANDATORY_PARAM
            ),
        ),
        '/optional[/:id]' => array(
            'controller' => 'index',
            'action' => 'index',
            'params' => array(),
        ),
        '/both/:mandatory/:and[/:optional]' => array(
            'controller' => 'index',
            'action' => 'index',
            'params' => array(),
        ),
    ),
    'db' => array(
            'host' => '127.0.0.1',
            'database' => 'selmalda',
            'user' => 'root',
            'pass' => '[123456]'
    ),
    'templates' => array(
        'layout'
    ),
);