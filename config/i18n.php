<?php

return [
    'i18n' => [
        'translations_dir' => 'data/translations',
        'type' => \Zend\I18n\Translator\Loader\Gettext::class,
        'default_locale' => 'en_GB',
        'supported_locales' => ['en_GB', 'nl_BE', 'es_ES'],
    ]
];