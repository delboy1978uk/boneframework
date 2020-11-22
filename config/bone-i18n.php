<?php

use Laminas\I18n\Translator\Loader\Gettext;

return [
    'i18n' => [
        'enabled' => true,
        'translations_dir' => 'data/translations',
        'type' => Gettext::class,
        'default_locale' => 'en_GB',
        'supported_locales' => ['en_PI', 'en_GB', 'nl_BE', 'fr_BE'],
        'date_format' => 'd/m/Y',
    ]
];