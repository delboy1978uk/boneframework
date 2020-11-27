<?php

return [
    'bone-contact' => [
        'sendThanksEmail' => true,
        'notificationEmailAddress' => 'pirates@highseas.com',
        'emailLayout' => 'contact::mail-layout',
        'formLayout' => 'layouts::bone',
        'adminLayout' => 'layouts::admin',
        'formClass' => \Bone\Contact\Form\ContactForm::class,
        'entityClass' => \Bone\Contact\Entity\Contact::class,
        'storeInDb' => true,
    ],
];