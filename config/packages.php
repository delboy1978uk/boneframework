<?php

use Bone\App\AppPackage;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Bone\Mail\MailPackage;
use Bone\OAuth2\BoneOAuth2Package;
use Bone\OpenApi\OpenApiPackage;
use Bone\Paseto\PasetoPackage;
use Del\Person\PersonPackage;
use Bone\User\BoneUserPackage;
use Del\UserPackage;

return [
    'packages' => [
        MailPackage::class,
        BoneDoctrinePackage::class,
        PasetoPackage::class,
        PersonPackage::class,
        UserPackage::class,
        BoneUserPackage::class,
        BoneOAuth2Package::class,
        OpenApiPackage::class,
        AppPackage::class,
    ],
];
