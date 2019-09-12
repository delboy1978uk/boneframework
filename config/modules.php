<?php

/**
 * modules go in src/ModuleName and have a ModuleNamePackage implementing
 * packages are vendor modules vendor entity packages like 'delboy1978uk/user'
 * and if using migrant command (an extended doctrine migrations) will add to entity paths for generating migrations
 * @see https://github.com/delboy1978uk/common for more details
 */

use BoneMvc\Module\App\AppPackage;
use BoneMvc\Module\BoneMvcDoctrine\BoneMvcDoctrinePackage;
use BoneMvc\Module\Unicorn\UnicornPackage;

return [
    'packages' => [
        AppPackage::class,
        BoneMvcDoctrinePackage::class,
        UnicornPackage::class,
    ],
    'viewFolder' => 'src/App/View'
];
