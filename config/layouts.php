<?php

return [
    'default_layout' => 'layouts/bonemvc',
    'available_layouts' => [
        'layouts/bonemvc',
    ],
    'error_pages' => [
        'exception' => 'error/error',
        401 => 'error/not-authorised',
        403 => 'error/not-authorised',
        404 => 'error/not-found',
        405 => 'error/not-allowed',
        500 => 'error/error',
    ],
];