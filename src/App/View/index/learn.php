<section id="learn-jumbo" class="jumbotron text-center bg-white">
    <div class="container">
        <img src="/img/skull_and_crossbones.png" />
        <h1 class="jumbotron-heading text-white"><?= $this->t('learn.learn') ;?></h1>
        <p class="lead text-white"><?= $this->t('learn.tagline') ;?></p>
    </div>
</section>

<section class="about-section text-center" id="installation">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 ><?= $this->t('installation') ;?></h2>
                <p ><?= $this->t('learn.composer') ;?>
                    <a target="_blank" href="https://getcomposer.org/">Composer</a>! <?= $this->t('learn.install.bone') ;?>
                </p>
                <code>composer create-project delboy1978uk/boneframework your/path/here</code>
                <br>&nbsp;
                <p><?= $this->t('learn.globally') ;?></p>
                <code>php composer.phar create-project delboy1978uk/boneframework your/path/here</code>
                <br class="mb50">
                <h2 ><?= $this->t('docker.devbox') ;?></h2>
                <p ><?= $this->t('docker.about') ;?><br class="mb20" />
                    <code>awesome.scot 192.168.99.100</code></p>
                <div class="code tl">
                    docker-machine start <br>
                    eval $(docker-machine env) <br>
                    cd /path/to/project <br>
                    docker-compose up <br>
                </div>
                <p><?= $this->t('docker.browse') ;?></p>
            </div>
        </div>
    </div>
</section>

<section id="contribute" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20"><?= $this->t('learn.config') ;?></h2>
            <p><?= $this->t('learn.config.drop') ;?></p>
            <div class="code tl">
                db.php
                i18n.php
                logs.php
                mail.php
                routes.php
                templates.php
            </div>
            <p><?= $this->t('learn.config.registry') ;?></p>
            <br>
            <h3><?= $this->t('database') ;?></h3>
            <p><?= $this->t('learn.db') ;?></p>
            <div class="code tl">
                'db' => array(
                'host' => '127.0.0.1',
                'database' => 'bone',
                'user' => 'LeChuck',
                'pass' => 'monkeyIsland'
                ),
            </div>
            <br>
            <h3><?= $this->t('i18n') ;?></h3>
            <p><?= $this->t('learn.i18n.about') ;?></p>
            <div class="code tl">
                &lt;?php

                    return [
                        'i18n' => [
                            'translations_dir' => 'data/translations',
                            'type' => \Zend\I18n\Translator\Loader\Gettext::class,
                            'default_locale' => 'en_PI',
                            'supported_locales' => ['en_PI', 'en_GB', 'nl_BE', 'fr_BE'],
                        ]
                    ];
            </div>
            <p><?= $this->t('learn.i18n.usage') ;?>To use the translator, you can simply call:</p>
            <div class="code tl">
                // from a controller:
                $this->getTranslator()->translate('placeholder.string');
                // to set locale
                $this->getTranslator()->setLocale($locale);

                // from a view file:
                $this->t('placeholder');
            </div>
            <br>
            <h3><?= $this->t('logs') ;?></h3>
            <p><?= $this->t('learn.logs') ;?></p>
            <div class="code tl">
                &lt;?php

                return [
                    'log' => [
                        'channels' => [
                            'default' => 'data/logs/default_log',
                        ],
                    ],
                ];
            </div>
            <p><?= $this->t('learn.logs.usage') ;?></p>
            <div class="code tl">
                $this->getLog()->debug($message) // or error(), etc, see PSR-3
            </div>
            <br>
            <h3><?= $this->t('mail') ;?></h3>
            <p><?= $this->t('learn.mail') ;?></p>
            <div class="code tl">
                &lt;?php

                return [
                    'mail' => [
                    'name'              => '127.0.0.1',
                    'host'              => 'localhost',
                    'port'              => 25,
                //        'connection_class'  => 'login', // plain, login, crammd5
                //        'connection_config' => [
                //            'username' => 'user',
                //            'password' => 'pass',
                //        ],
                    ],
                ];
            </div>
            <p><?= $this->t('learn.mail.hog') ;?></p>
            <br />
            <h3><?= $this->t('routes') ;?></h3>
            <p><?= $this->t('learn.routes') ;?></p>
            <div class="code tl">&lt;?php

            return [
                'routes' => [
                    '/' => [
                        'controller' => 'index',
                        'action' => 'index',
                        'params' => [],
                    ],
                    '/:locale' => [
                        'controller' => 'index',
                        'action' => 'index',
                        'params' => [],
                    ],
                    '/optional[/:id]' => [
                        'controller' => 'index',
                        'action' => 'index',
                        'params' => [],
                    ],
                ],
            ];
            </div>
            <p><?= $this->t('learn.routes.params') ;?></p>

            <br />
            <h3><?= $this->t('layouts') ;?></h3>
            <p><?= $this->t('learn.layouts') ;?></p>
        </div>
    </div>
</section>


<!-- Custom Theme JavaScript -->
<script src="js/grayscale.js"></script>
