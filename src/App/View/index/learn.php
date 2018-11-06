<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/<?= $this->e($locale) ;?>#page-top">
                <i class="fa fa-play-circle"></i>  <span class="light">Bone</span> MVC Framework
            </a>
        </div>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a href="/#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="/#about"><?= $this->t('about') ;?></a>
                </li>
                <li class="page-scroll">
                    <a href="/#download"><?= $this->t('download') ;?></a>
                </li>
                <li class="page-scroll">
                    <a href="/#contribute"><?= $this->t('contribute') ;?></a>
                </li>
                <li class="">
                    <a href="#"><?= $this->t('learn') ;?></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->t('language') ;?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/en_PI/learn">Pirate</a></li>
                        <li><a href="/en_GB/learn">English</a></li>
                        <li><a href="/nl_BE/learn">Nederlands</a></li>
                        <li><a href="/fr_BE/learn">Français</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<section class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <img height="64" src="/img/skull_and_crossbones.png" />
                    <h2 class=""><?= $this->t('learn.learn') ;?></h2>
                    <p class="intro-text"><?= $this->t('learn.tagline') ;?></p>
                    <div class="page-scroll">
                        <a href="#installation" class="btn btn-circle">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="installation" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2><?= $this->t('installation') ;?></h2>
            <p><?= $this->t('learn.composer') ;?> <a href="https://getcomposer.org/">Composer</a>! <?= $this->t('learn.install.bone') ;?></p>
            <code>composer create-project delboy1978uk/bonemvc your/path/here dev-master</code>
            <p class="clear"><?= $this->t('learn.globally') ;?></p>
            <code>php composer.phar create-project delboy1978uk/bonemvc your/path/here dev-master</code>
            <br class="mb50">
            <h2><?= $this->t('docker.devbox') ;?>Docker Dev Box</h2>
            <p><?= $this->t('docker.about') ;?>Bone comes with a docker-compose.yml in the project, so you can instantly
                get a dev server running if you use Docker (Tested using a default VirtualBox VM). Just add this to your
                hosts file<br class="mb20" />
                <code>awesome.scot 192.168.99.100</code></p>
            <div class="code tl">
                docker-machine start
                eval $(docker-machine env)
                cd /path/to/project
                docker-compose up
            </div>
            <p>Then you can access the site at https://awesome.scot in your browser. Of course if you don't use docker
                you can add it to your LAMP stack in the usual way.</p>
        </div>
    </div>
</section>

<section id="configger" class="content-section text-center pt50">
    <div class="download-section">
        <div class="container">
            <div class="col-lg-8 col-lg-offset-2">
                <h2><?= $this->t('configure') ;?></h2>
                <p><?= $this->t('learn.folders') ;?></p>
                <p><?= $this->t('learn.777') ;?></p>
                <code>chmod -R 775 data</code>
                <p><?= $this->t('learn.vhosts') ;?></p>
                <div class="code tl">
        &lt;VirtualHost *:80&gt;
                DocumentRoot "/var/www/bonemvc/public"
                ServerName awesome.scot
                SetEnv APPLICATION_ENV development
                &lt;Directory "/var/www/bonemvc"&gt;
                        DirectoryIndex index.php
                        FallbackResource /index.php
                        Options -Indexes +FollowSymLinks
                        AllowOverride all
                        Require all granted
                &lt;/Directory&gt;
        &lt;/VirtualHost&gt;
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contribute" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2><?= $this->t('learn.config') ;?></h2>
            <p>You can drop in any number of <span class="label label-success">.php</span> files into the
                <span class="label label-success">config/</span> folder. Make sure they return an array with the config
                . You can override configuration based on environment var
                <span class="label label-success">APPLICATION_ENV</span>, so for instance if the environment was production
            it would load the additional config the production subdirectory.</p>
            <p>There are several config files by default:</p>
            <div class="code tl">
                db.php
                i18n.php
                logs.php
                mail.php
                routes.php
                templates.php
            </div>
            <p>In your config files, you can add anything you want. It gets stored in the Bone\Mvc\Registry.</p>
            <br>
            <h3>Database</h3>
            <p>Set your default db credentials in the main config/db.php, and any environment specific configs in a
                subdirectory</p>
            <div class="code tl">
                'db' => array(
                'host' => '127.0.0.1',
                'database' => 'bone',
                'user' => 'LeChuck',
                'pass' => 'monkeyIsland'
                ),
            </div>
            <br>
            <h3>Internationalisation</h3>
            <p>Bone supports translation into different locales. Translation files (gettext .po and .mo) should be
                placed in data/translations, under a subdirectory of the locale, eg data/translations/en_GB/en_GB.po.
                You can set the default locale and an array of supported locales.</p>
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
            <p>To use the translator, you can simply call:</p>
            <div class="code tl">
                // from a controller:
                $this->getTranslator()->translate('placeholder.string');
                // to set locale
                $this->getTranslator()->setLocale($locale);

                // from a view file:
                $this->t('placeholder');
            </div>
            <br>
            <h3>Logs</h3>
            <p>Bone uses monolog/monolog, and logs can be found in <span class="label label-success">data/logs</span>.
            Currently we only support writing to files, but you can add as many channels as you like:</p>
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
            <p>To use the logger in a controller:</p>
            <div class="code tl">
                $this->getLog()->debug($message) // or error(), etc, see PSR-3
            </div>
            <br>
            <h3>Mail</h3>
            <p>Bone uses Zend Mail. To configure the mail client, just drop in your config (see zend mail docs)</p>
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
            <p>If you are using the Docker Box provided by bone, you also have the awesome MailHog at your disposal.
            Browse to awesome.scot:8025 and you'll see a catch all email inbox, so you never need to worry about development
            emails reaching the real world.</p>
            <br />
            <h3>Routes</h3>
            <p>Routes follow a default pattern of /controller/action/param/value/nextparam/nextvalue/etc/etc</p>
            <p>You can also override routes by defining them in the config array:</p>
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
            <p>When defining routes, mandatory variables in the uri have a colon like :id<br /> Optional uri vars have
                [ ] surrounding them like [:id]</p>

            <br />
            <h3>Layouts</h3>
            <p>Ignore this config. It's old deprecated nonsense.</p>
        </div>
    </div>
</section>


<!-- Custom Theme JavaScript -->
<script src="js/grayscale.js"></script>
