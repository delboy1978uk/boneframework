<?php

use Bone\App\AppPackage;

return [
    'packages' => [
        \Bone\Mail\MailPackage::class,
        \Bone\BoneDoctrine\BoneDoctrinePackage::class,
        \Del\Person\PersonPackage::class,
        \Del\UserPackage::class,
        \Bone\User\BoneUserPackage::class,
        AppPackage::class,
    ],
];
