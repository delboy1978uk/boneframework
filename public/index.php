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
//                          :           ____   __   __ _  ____
//                          :          (  _ \ /  \ (  ( \(  __)
//                                      ) _ ((  O )/    / ) _)
//                                     (____/ \__/ \_)__)(____)


\chdir(\dirname(__DIR__));

if (!\defined('APPLICATION_PATH')) {
    \define('APPLICATION_PATH', dirname(__DIR__) . '/');
}

/** I be autoloadin' th' composer or else shiver me timbers */
if (!file_exists('vendor/autoload.php')) {
    throw new RuntimeException(
        'Garrrr! Unable t\'load Bone. Run `composer install` or `php composer.phar install`'
    );
}

require_once 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(APPLICATION_PATH);
$dotenv->safeLoad();
define('APPLICATION_ENV', $_ENV['APPLICATION_ENV'] ?? 'production');


/** Time t'begin th'voyage me hearties!*/
Bone\Application::ahoy()->setSail();
