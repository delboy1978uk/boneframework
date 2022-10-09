<?php

use Bone\App\AppPackage;
use Bone\BoneDoctrine\BoneDoctrinePackage;
use Bone\Mail\MailPackage;

return [
    'packages' => [
        MailPackage::class,
        BoneDoctrinePackage::class,
        AppPackage::class,
    ],
];
