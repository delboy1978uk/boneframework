<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Bone Framework</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#about"><?= $this->t('about') ;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#download"><?= $this->t('download') ;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contribute"><?= $this->t('contribute') ;?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/<?= Locale::getDefault(); ?>/learn"><?= $this->t('learn') ;?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?= $this->t('language') ;?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/en_PI/learn">Pirate</a>
                        <a class="dropdown-item" href="/en_GB/learn">English</a>
                        <a class="dropdown-item" href="/nl_BE/learn">Nederlands</a>
                        <a class="dropdown-item" href="/fr_BE/learn">Français</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>



<!-- Masthead-->
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <img src="/img/skull_and_crossbones.png" />
            <h1 class="mx-auto my-0 text-uppercase"><?= $this->t('learn.learn') ;?></h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5"><?= $this->t('learn.tagline') ;?></h2>
            <a class="btn btn-primary js-scroll-trigger p0 pl10 pr10" href="#installation"><i class="fa fa-5x fa-angle-double-down animated"></i></a>
        </div>
    </div>
</header>

<section class="about-section text-center" id="installation">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white"><?= $this->t('installation') ;?></h2>
                <p class="text-white"><?= $this->t('learn.composer') ;?>
                    <a target="_blank" href="https://getcomposer.org/">Composer</a>! <?= $this->t('learn.install.bone') ;?>
                </p>
                <code>composer create-project delboy1978uk/boneframework your/path/here</code>
                <p class="clear text-white"><?= $this->t('learn.globally') ;?></p>
                <code>php composer.phar create-project delboy1978uk/boneframework your/path/here</code>
                <br class="mb50">
                <h2 class="text-white"><?= $this->t('docker.devbox') ;?></h2>
                <p class="text-white"><?= $this->t('docker.about') ;?><br class="mb20" />
                    <code>awesome.scot 192.168.99.100</code></p>
                <div class="code tl">
                    docker-machine start
                    eval $(docker-machine env)
                    cd /path/to/project
                    docker-compose up
                </div>
                <p><?= $this->t('docker.browse') ;?></p>
            </div>
        </div>
        <img class="img-fluid" src="assets/img/ipad.png" alt="" />
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
