<?php

return [
    'oauth2' => [
        'clientCredentialsTokenTTL' => 'PT1H', // 1hour
        'authCodeTTL' => 'PT1M', // 1 minute
        'accessTokenTTL' => 'P1M', // 5 minutes
        'refreshTokenTTL' => 'P1M', // 1 month
        'privateKeyPath' => __DIR__ . '/../data/keys/private.key',
        'publicKeyPath' => __DIR__ . '/../data/keys/public.key',
        'encryptionKey' => 'def000002e113a725ebc60dc305541e09588776f65a17cf3258d8f7194bc3c38f62b0fe818cc026833bd1226b52e721534dee4e9db832977e1bc9ce764b848ad9fb3581f',
    ]
];
