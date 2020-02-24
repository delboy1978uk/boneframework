<?php

use Bone\Firewall\FirewallPackage;
use Bone\OAuth2\BoneOAuth2Package;
use Bone\OpenApi\OpenApiPackage;
use BoneMvc\Mail\MailPackage;
use BoneMvc\Module\App\AppPackage;
use BoneMvc\Module\BoneMvcDoctrine\BoneMvcDoctrinePackage;
use BoneMvc\Module\BoneMvcUser\BoneMvcUserPackage;
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
        OpenApiPackage::class,
        AppPackage::class,
    ],
    'viewFolder' => 'src/App/View'
];
