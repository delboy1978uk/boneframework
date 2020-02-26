<?php

/**
 *  delboy1978uk/bone-firewall
 *  add routes that you would like to disable from vendor packages
 *  they are defined in the package class in their src/ folders
 *
 *  Or, if you need to add middleware on to a particular route, you can do that also
 *  Each key can hold either an actual instance of the middleware,
 *  a string representing the middleware which would be found in the container,
 *  or an array of either if you wish to add multiple middleware
 */
return [
    'blockedRoutes' => [
//        '/user/register',
//        '/user/lost-password/{email}',
    ],
    'routeMiddleware' => [
//        '/api/some/endpoint' => SomeMiddleware::class,
//        '/api/another/endpoint' => new AwesomeMiddleware(),
//        '/api/yet/another/endpoint' => [
//            new AwesomeMiddleware(),
//            SomeMidlleware::class,
//        ],
    ],
];