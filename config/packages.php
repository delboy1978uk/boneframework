<?php

use Bone\App\AppPackage;
use Bone\Mail\MailPackage;

return [
    'packages' => [
        MailPackage::class,
        AppPackage::class,
    ],
];
