<?php

use BoneMvc\Module\App\AppPackage;
use BoneMvc\Module\BoneMvcDoctrine\BoneMvcDoctrinePackage;
use BoneMvc\Module\BoneMvcUser\BoneMvcUserPackage;

return [
    'packages' => [
        AppPackage::class,
        BoneMvcDoctrinePackage::class,
        BoneMvcUserPackage::class,
    ],
    'viewFolder' => 'src/App/View'
];
