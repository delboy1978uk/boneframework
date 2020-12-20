<?php

return [
    'default_layout' => 'layouts::bone',
    'admin_layout' => 'layouts::admin',
    'error_pages' => [
        'exception' => 'error::error',
        401 => 'error::not-authenticated',
        403 => 'error::not-authorised',
        404 => 'error::not-found',
        405 => 'error::not-allowed',
        500 => 'error::error',
    ],
];