<?php

use BoneMvc\Mail\MailPackage;
use BoneMvc\Module\App\AppPackage;
use BoneMvc\Module\BoneMvcDoctrine\BoneMvcDoctrinePackage;
use BoneMvc\Module\BoneMvcUser\BoneMvcUserPackage;
use BoneMvc\Module\Test\TestPackage;
use Del\Person\PersonPackage;
use Del\UserPackage;

return [
    'packages' => [
        AppPackage::class,
        BoneMvcDoctrinePackage::class,
        MailPackage::class,
        PersonPackage::class,
        UserPackage::class,
        BoneMvcUserPackage::class,
        TestPackage::class,
    ],
    'viewFolder' => 'src/App/View'
];
