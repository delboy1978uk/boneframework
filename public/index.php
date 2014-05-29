<?php

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

if (!file_exists('vendor/autoload.php')) {
    throw new RuntimeException(
        'Unable to load Bone. Run `php composer.phar install` or define a ZF2_PATH environment variable.'
    );
}

// Setup autoloading
/** @var \Composer\Autoload\ClassLoader $loader  */
$loader = require_once 'vendor/autoload.php';


// Setup Environment Variables
if (!defined('APPLICATION_PATH'))
{
    define('APPLICATION_PATH', realpath(__DIR__ . '/../'));
}

// Load Config
$config = require_once APPLICATION_PATH . '/config/config.php';

// Replace Config values with development ones if they are there
if (file_exists( APPLICATION_PATH . '/config/config.dev.php'))
{
    require_once ( APPLICATION_PATH . '/config/config.dev.php');
}

Bone\Mvc\Application::init($config)->run();
