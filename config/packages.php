<?php

use BoneMvc\Module\App\AppPackage;
use BoneMvc\Module\BoneMvcDoctrine\BoneMvcDoctrinePackage;
use BoneMvc\Module\BoneMvcUser\BoneMvcUserPackage;
use BoneMvc\Module\Mp\MpPackage;
use Random\Developer\Jedi\JediPackage;

return [
    'packages' => [
        AppPackage::class,
        BoneMvcDoctrinePackage::class,
        BoneMvcUserPackage::class,
        JediPackage::class,
        MpPackage::class,
    ],
    'viewFolder' => 'src/App/View'
];
