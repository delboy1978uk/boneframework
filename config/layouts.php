<?php

return [
    'viewFolder' => 'src/App/View',
    'default_layout' => 'layouts/bone',
    'available_layouts' => [
        'layouts/bone',
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