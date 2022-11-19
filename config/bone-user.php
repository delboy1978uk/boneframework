<?php

/**
 *  If you use bone-user you can set a redirect url upon user login by uncommenting this
 *  Enable registration allows visitors to sign up for an account at /user/register
 *  Require Profile will redirect to the edit profile page if they have no profile
 */
return [
    'bone-user' => [
//        'loginRedirectRoute' => '/admin',
        'enableRegistration' => true,
        'requireProfile' => false,
        'rememberMeCookie' => true,
    ],
];
