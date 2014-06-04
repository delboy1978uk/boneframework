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
        '/mandatory/:id' => array(
            'controller' => 'index',
            'action' => 'index',
            'params' => array(),
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
    'db-adapters' => array(
        'db' => array(
            'host' => '127.0.0.1',
            'database' => '',
            'user' => '',
            'pass' => ''
        ),
    ),
);