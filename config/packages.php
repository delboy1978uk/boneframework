<?php

use Bone\OAuth2\BoneOAuth2Package;
use BoneMvc\Mail\MailPackage;
use BoneMvc\Module\App\AppPackage;
use BoneMvc\Module\BoneMvcDoctrine\BoneMvcDoctrinePackage;
use BoneMvc\Module\BoneMvcUser\BoneMvcUserPackage;
use BoneMvc\Module\Test\TestPackage;
use Del\Person\PersonPackage;
use Del\UserPackage;

return [
    'packages' => [
        BoneMvcDoctrinePackage::class,
        MailPackage::class,
        PersonPackage::class,
        UserPackage::class,
        BoneMvcUserPackage::class,
        BoneOAuth2Package::class,
        TestPackage::class,
        AppPackage::class,
    ],
    'viewFolder' => 'src/App/View'
];
