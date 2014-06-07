<?php

//                            7 ,::::::::                         
//                          + :::::::::,  :                 ?     
//                          :::::::::: ::::::~              7777  
//      ,: 7               ::::::::: :: =7777~             7+777  
//        +  77777           :::::::::: 777777777           ,77+77=7  
//        ~77 :77777          ::::::=7,7777777777          77+777777  
//        77777777:77777      :::,777 ?7777777777~     +7777777777I?  
//    :777 7II7777777777  ::77     7~+     77:  ?7777777          
//      =?       : I7777 = :       77:     ~7 777777 ,            
//                     7 7 7      7  7     77,777 =               
//                     ,7 777    7I  777I77?7: ,                  
//                     , , 7777777    77777:                      
//                       7:   7777  ??777? ~                      
//                       :  ,7 7777777777 7I7 =                   
//                     , ::::77=77777?77777+7777I ?               
//                   777:: ::777:      +777 + ~77777              
//               777777  :,:::777:     777        777777      I7  
//     , 777777+I777    :::,::77777,~+7777I        ,,777I 777777, 
//      7 7777I77,~     :::::,: 777777777~           ~=7777 77:7  
//         77777 77 +      ,:::: ::7 777777I=               7777  77  
//     ,77?777           : : :      = ,                 +777?77~  
//     +777 7            :,:::~                            77I    
//        77?              +::                                    
//                         =::                                    
//                          :           ____   __   __ _  ____  _  _  _  _   ___
//                          :          (  _ \ /  \ (  ( \(  __)( \/ )/ )( \ / __)
//                                      ) _ ((  O )/    / ) _) / \/ \\ \/ /( (__
//                                     (____/ \__/ \_)__)(____)\_)(_/ \__/  \___)



/**
 *
 * I be settin' up th'application path
 *
 */
chdir(dirname(__DIR__));
if (!defined('APPLICATION_PATH'))
{
    define('APPLICATION_PATH', realpath(__DIR__ . '/../'));
}


/**
 *
 * I be autoloadin' th'composer or else shiver me timbers
 *
 */
if (!file_exists('vendor/autoload.php'))
{
    throw new RuntimeException(
        'Garrrr! Unable t\'load Bone. Run `composer install` or `php composer.phar install`'
    );
}
$loader = require_once 'vendor/autoload.php';


/**
 *
 *  Whit be yer configuration, sonny?
 *
 */
$config = require_once APPLICATION_PATH . '/config/config.php';


/**
 *
 *  Be ye on the practice ship?
 *
 */
if (file_exists( APPLICATION_PATH . '/config/config.dev.php'))
{
    $config = array_merge($config, require_once ( APPLICATION_PATH . '/config/config.dev.php'));
}

/**
 *
 *  Time t'begin th'voyage me hearties!
 *
 */
Bone\Mvc\Application::ahoy($config)->setSail();
