<?php

use Bone\App\AppPackage;
use Bone\OAuth2\BoneOAuth2Package;
use Bone\OpenApi\OpenApiPackage;
use Bone\Mail\MailPackage;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Bone\User\BoneUserPackage;

return [
    'packages' => [
        BoneDoctrinePackage::class,
        MailPackage::class,
        BoneUserPackage::class,
        BoneOAuth2Package::class,
        OpenApiPackage::class,
        AppPackage::class,
    ],
];
