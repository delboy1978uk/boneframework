<div class="nav-scroller bg-white shadow-sm">
    <nav class="nav nav-underline">
        <span class="nav-link active">Jump to...</span>
        <a class="nav-link" href="#installation">Installation</a>
        <a class="nav-link" href="#config">Config</a>
        <a class="nav-link" href="#packages">Packages</a>
        <a class="nav-link" href="#routing">Routing</a>
        <a class="nav-link" href="#middleware">Middleware</a>
        <a class="nav-link" href="#controllers">Controllers</a>
        <a class="nav-link" href="#views">Views</a>
        <a class="nav-link" href="#i18n">i18n</a>
        <a class="nav-link" href="#i18n">Logs</a>
        <a class="nav-link" href="#cli">CLI</a>
    </nav>
</div>
<section id="learn-jumbo" class="jumbotron text-center bg-white">
    <div class="container">
        <img src="/img/skull_and_crossbones.png"/>
        <h1 class="jumbotron-heading text-white"><?= $this->t('learn.learn'); ?></h1>
        <p class="lead text-white"><?= $this->t('learn.tagline'); ?></p>
    </div>
</section>
<br>&nbsp;<br>
<section class="about-section text-center" id="installation">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-muted"><?= $this->t('installation'); ?></h2>
                <p class="text-muted">There are two ways to get started, if you already have a LAMP stack set up, then
                    you can install using Composer. However, Bone Framework comes with a Docker LAMP stack out of the
                    box,
                    so it's even easier to get up and running.</p>
                <h4 class="text-muted">...via Composer</h4>
                <p class="text-muted"><?= $this->t('learn.composer'); ?>
                    <a target="_blank"
                       href="https://getcomposer.org/">Composer</a>! <?= $this->t('learn.install.bone'); ?>
                </p>
                <code>composer create-project delboy1978uk/boneframework your/path/here</code>
                <br>&nbsp;
                <p class="text-muted"><?= $this->t('learn.globally'); ?></p>
                <code>php composer.phar create-project delboy1978uk/boneframework your/path/here</code>
                <br class="mb50">
                <h2 class="text-muted"><?= $this->t('docker.devbox'); ?></h2>
                <p class="text-muted">To install Bone via Docker, instead use Git to clone the project</p>
                <div class="code tl">git clone https://github.com/delboy1978uk/boneframework yourProjectName</div>
                <p class="text-muted"><?= $this->t('docker.about'); ?><br class="mb20"/>
                    <code>awesome.scot 192.168.99.100</code></p>
                <div class="code tl">
                    docker-machine start <br>
                    eval $(docker-machine env) <br>
                    cd /path/to/project <br>
                    docker-compose up <br>
                </div>
                <br>
                Then you can access the site at <span class="code">https://awesome.scot</span> in your browser.
            </div>
        </div>
    </div>
</section>

<section id="config" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted">Config</h2>
            <p class="text-muted">You can drop in any number of .php files into the <span class="code">config/</span> folder. Make sure they
                return an array with the config. You can override configuration based on environment var
                <span class="code">APPLICATION_ENV</span>,
                so for instance if the environment was production it would load the additional config within the
                production subdirectory. There are default configs for optional packages such as bone-mail which have
                been added for convenience. </p>
            <p class="text-muted">The configurations you will probably want to take a look at first are the
                following:</p>
            <ul class="list-group text-left text-muted">
                <li class="list-group-item">site.php <span class="pull-right">
                       Site information such as domain name, site name, site logo, etc.
                   </span></li>
                <li class="list-group-item">packages.php <span class="pull-right">For adding <a href="#packages">packages</a> to your application</span>
                </li>
                <li class="list-group-item">bone-db.php <span class="pull-right">PDO connection information, also used
                    by the <a href="//github.com/delboy1978uk/bone-doctrine">bone-doctrine</a> package.</span></li>
                <li class="list-group-item">views.php <span
                            class="pull-right">For overriding vendor package view files</span></li>
                <li class="list-group-item">middleware.php <span class="pull-right">For adding site wide global <a
                                href="#middleware"></a>middleware</span></li>
                <li class="list-group-item">bone-firewall.php <span class="pull-right">For disabling vendor routes or adding middleware</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<section id="packages" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted">Packages</h2>
            <p class="text-muted">Bone Framework is truly modular, and all Package classes implement <span
                class="code">Barnacle\RegistrationInterface</span> (Barnacle is a <a target="_blank"
                href="//www.php-fig.org/psr/psr-11/">PSR-11</a> wrapper for Pimple DIC). There
                are various interfaces you can make the package implement in order to give your package more
                functionality.</p>
            <ul class="list-group text-left">
                <li class="list-group-item">
                    AssetRegistrationInterface <span class="pull-right">For vendor package asset folders</span>
                </li>
                <li class="list-group-item">
                    CommandRegistrationInterface <span class="pull-right">To add bone CLI commands</span>
                </li>
                <li class="list-group-item">
                    EntityRegistrationInterface <span class="pull-right">To set up
                        <a href="//github.com/delboy1978uk/bone-doctrine">bone-doctrine</a> database entity folders</span>
                </li>
                <li class="list-group-item">
                    I18nRegistrationInterface <span class="pull-right">To set up translation directories</span>
                </li>
                <li class="list-group-item">
                    MiddlewareRegistrationInterface <span class="pull-right">To add middleware to to the container</span>
                </li>
                <li class="list-group-item">
                    RouterConfigInterface <span class="pull-right">To set up routes to controller methods</span>
                </li>
                <li class="list-group-item">
                    ViewRegistrationInterface <span class="pull-right">To set up view folders</span>
                </li>
            </ul>
            <br>
            <p class="text-muted">Third party packages (or your own packagist packages) will reside in the <span class="code">vendor/</span>
            folder, rather than in <span class="code">src/</span>. If these packages have front end assets such as images
            or CSS or JavaScript, you must deply those assets using the <span class="code">bone assets:deploy</span> command.</p>
            <h4 class="text-muted">Ready to rock Bone Framework packages</h4>
            <p class="text-muted">Several Packages are available already for installation via composer to Bone Framework</p>
            <ul class="list-group text-left text-muted">
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-crypt">delboy1978uk/bone-crypt</a>
                    <span class="pull-right">OpenSSL encryption/decryption package</span>
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-doctrine">delboy1978uk/bone-doctrine</a>
                    <span class="pull-right">Doctrine ORM package</span>
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-ios">delboy1978uk/bone-ios</a>
                    <span class="pull-right">iOS Swift project for connecting to Bone OAuth2 server</span>
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-mail">delboy1978uk/bone-mail</a>
                    <span class="pull-right">Mail server package</span>
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-oauth2">delboy1978uk/bone-oauth2</a>
                    <span class="pull-right">OAuth2 server package</span>
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-open-api">delboy1978uk/bone-open-api</a>
                    <span class="pull-right">Open API documentation package</span>
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-passport">delboy1978uk/bone-passport</a>
                    <span class="pull-right">ACL package</span>
                </li>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-pay">delboy1978uk/bone-pay</a>
                    <span class="pull-right">Payment Gateway package</span>
                <li class="list-group-item">
                    <a target="_blank" href="//github.com/delboy1978uk/bone-user">delboy1978uk/bone-user</a>
                    <span class="pull-right">Fully featured user registration package</span>
                </li>
                </li>
            </ul>
        </div>
    </div>
</section>

<section id="routing" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted">Routing</h2>
            <p class="text-muted">Bone's router is a fork of <a href="//route.thephpleague.com/4.x/">league/route</a>.</p>
            <p class="text-muted">Routes are defined in your package class by implementing <span class="code">
                Bone\Router\RouterConfigInterface</span></p>
            <p class="text-muted">Variable parts of the route are surrounded in curly braces.</p>
            <div class="code tl">
<pre>
/**
 * @param Container $c
 * @param Router $router
 * @return Router
 */
public function addRoutes(Container $c, Router $router): Router
{
    $router->map('GET', '/learn', [IndexController::class, 'learn']);
    $router->map('GET', '/with/{customVariable}', [
        IndexController::class, 'somewhere'
    ]);
    $router->map('GET', '/with/{id:number}', [
        IndexController::class, 'somewhereElse'
    ]);
    $router->map('POST', '/with/{name:word}', [
        IndexController::class, 'somewhereElse'
    ]);

    return $router;
}
</pre>
            </div>
            <p class="text-muted">Variables can be fetched in your controller by calling</p>
            <div class="code text-left">$request->getAttribute('yourVariable')</div>
        </div>
    </div>
</section>

<section id="middleware" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted">Middleware</h2>
            <p class="text-muted">Bone Framework can use <a target="_blank" href="https://www.php-fig.org/psr/psr-15/">
                    PSR-15</a> middleware to create a layered application.</p>
            <img style="max-width: 400px;" class="shadow" src="/img/middleware.png" alt="Middleware"/>
            <br>&nbsp;<br>
            <p class="text-muted">As an example, <span class="code">bone-i18n</span> uses middleware to take in the
                request, check for a URL starting with a supported locale (e.g. /en_GB/user/login), set the locale so that
                translations can take place in the correct language, and remove that part of the URL before passing the new
                request (e.g. with URL now set to /user/login) to the next middleware in the stack. The end of the middleware
                chain (Application in the above image) is your controller method defined in the packages router setup.</p>
            <p class="text-muted">Middleware can be added on a global level by adding to <span class="code">
                config/middleware.php</span>, or can be added to an individual route or a group of routes in the
                package route setup, like this:
            </p>
            <div class="code tl">
<pre>
/**
 * @param Container $c
 * @param Router $router
 * @return Router
 */
public function addRoutes(Container $c, Router $router): Router
{
    $awesomeMiddleware = new AwesomeMiddleware();
    $router->map('GET', '/learn', [IndexController::class, 'learn'])
           ->middlewares([$awesomeMiddleware]);

    return $router;
}
</pre>
            </div>
        </div>
    </div>
</section>

<section id="controllers" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted">Controllers</h2>
            <p class="text-muted">Controllers can be as simple or as complex as you need. If a controller has
                dependencies, you should create a factory in the Packages <span class="code">addToContainer()</span>
            method. See <span class="code">src/App/AppPackage</span> for an example, a controller which extends
            <span class="code">Bone\Controller\Controller</span>, a class providing a translator, view engine,
                and site config object.</p>
            <p class="text-muted">Bone also provides some interfaces and convenience getter and setter traits:</p>
            <ul class="list-group text-left text-muted">
                <li class="list-group-item">I18nAwareInterface
                    <span class="pull-right">use HasTranslatorTrait</span>
                </li>
                <li class="list-group-item">LoggerAwareInterface
                    <span class="pull-right">use HasLoggerTrait</span>
                </li>
                <li class="list-group-item">SessionAwareInterface
                    <span class="pull-right">use HasSessionTrait</span>
                </li>
                <li class="list-group-item">SiteConfigAwareInterface
                    <span class="pull-right">use HasSiteConfigTrait</span>
                </li>
                <li class="list-group-item">ViewAwareInterface
                    <span class="pull-right">use HasViewTrait</span>
                </li>
            </ul>
            <br>
            <p class="text-muted">All of these interfaces can be automatically configured in the dependency injection
                container by passing your controller into <span class="code">Bone\Controller\Init</span> in your package
                class, like so:</p>
            <div class="code tl">
<pre>
/**
 * @param Container $c
 */
public function addToContainer(Container $c)
{
    $c[IndexController::class] = $c->factory(function (Container $c) {
        $controller = new IndexController();

        return Init::controller($controller, $c);
    });
}
</pre>
            </div>
            <p class="text-muted">Controller methods called by the router should look like a PSR-15 <span class="code">
                    RequestHandlerInterface</span>, except the method name doesn't obviously need to be called "handle".</p>
            <div class="code tl">
<pre>
/**
 * @param ServerRequestInterface $request
 * @param array $args
 * @return ResponseInterface
 */
public function indexAction(ServerRequestInterface $request) : ResponseInterface
{
    $body = $this->view->render('app::index');

    return new HtmlResponse($body);
}
</pre>
            </div>
            <p class="text-muted">Bone Framework uses <a href="//docs.laminas.dev/laminas-diactoros/">Diactoros</a> for
                its ServerRequest and Response objects.</p>
        </div>
    </div>
</section>

<section id="views" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted">Views</h2>
            <p class="text-muted">View scripts are based on <a target="_blank" href="//platesphp.com/">PlatesPHP</a>.
                Packages which have routes with view files should implement
                <span class="code">Bone\View\ViewRegistrationInterface</span></p>
            <div class="code tl"><pre>
&lt;?php

class SomePackage implements RegistrationInterface, ViewRegistrationInterface
{
    // other code here ...

    /**
     * @return array
     */
    public function addViews(): array
    {
        return [
            'app' => __DIR__ . '/View/index',
            'error' => __DIR__ . '/View/error',
            'layouts' => __DIR__ . '/View/layouts',
        ];
    }


    /**
     * @param Container $c
     * @return array
     */
    public function addViewExtensions(Container $c): array
    {
        $someExtension = new SomeViewExtension();

        return [$someExtension];
    }
}</pre>
            </div>
            <p class="text-muted">To render a view in your controller, call the following code, passing in the variables
                of your choice as an array. You can echo the var in the view by using the key name, i.e. in the example
            the key 'name' is <span class="code">$name</span> in the view file.</p>
            <div class="code tl">
                <pre>
$body = $this->view->render('app::index', [
    'name' => $someNameVariable,
    'date' => date('d/m/Y'),
]);
                </pre>
            </div>
            <p class="text-muted">There are also view extensions included, a paginator and a Bootstrap alert box. In
                your controller, you can set an array, the last item of the array being the alert class (such as
                alert-danger etc.)
            </p>
            <div class="code tl">
                <pre>
$body = $this->view->render('app::index', [
    'message' => ['Successfully added record to DB', 'success'],
]);
                </pre>
            </div>
            <p class="text-muted">In the view file, you can call the following:</p>
            <code>&lt;?= $this->alert($message) ?&gt;</code><br>&nbsp;<br>
            <p class="text-muted"><span class="code">@todo</span> Documentation for the paginator will be added once it
            has been refactored to work as a middleware component. Watch this space.</p>
        </div>
    </div>
</section>

<section id="i18n" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted"><?= $this->t('i18n'); ?></h2>
            <p class="text-muted">Bone uses Laminas i18n to support translation into different locales. <br>
                Translation files (gettext .po and
                .mo) should be placed in <span class="code">data/translations</span>, under a subdirectory of the
                locale,
                e.g. <span class="code">data/translations/en_GB/en_GB.po</span>. <br>You can set the default locale and
                an
                array of supported locales in <span class="code">config/bone-i18n.php</span>.</p>
            <div class="code tl"><pre>
&lt;?php

return [
    'i18n' => [
        'translations_dir' => 'data/translations',
        'type' => \Laminas\I18n\Translator\Loader\Gettext::class,
        'default_locale' => 'en_PI',
        'supported_locales' => ['en_PI', 'en_GB', 'nl_BE', 'fr_BE'],
    ]
                    ];</pre>
            </div>
            <p class="text-muted">To add internationalisation to a package, make your Package class implement <br>
                <span class="code">Bone\I18n\I18nRegistrationInterface</span></p>
            <div class="code tl"><pre>
&lt;?php

class SomePackage implements RegistrationInterface, I18nRegistrationInterface
{
    // other code here ...

    /**
     * @return string
     */
    public function getTranslationsDirectory(): string
    {
        return 'path/to/translations';
    }
}</pre>
            </div>
            <p class="text-muted">If you make your controller extend <span class="code">Bone\Controller\Controller
                    </span>, you can quickly inject the translator into your controller by passing it into
                <span class="code">Bone\Controller\Init</span> in your package's <span class="code">addToContainer()
                    </span> method:
            </p>
            <div class="code tl">
<pre>
/**
 * @param Container $c
 */
public function addToContainer(Container $c)
{
    $c[IndexController::class] = $c->factory(function (Container $c) {
        $controller = new IndexController();

        // adds i18n, view engine, site config info,
        // session manager, and logger to your controller
        return Init::controller($controller, $c);
    });
}
</pre>
            </div>
            <p class="text-muted">You can perform a translation in your controller like so:</p>
            <div class="code tl">$translator = $this->getTranslator(); <br>
                $translatedText = $translator->translate('welcome');
            </div>
            <p class="text-muted">You can perform a translation in your view like so:</p>
            <div class="code tl">&lt;?= $this->t('welcome') ?&gt;</div>
            <p class="text-muted">Finally, you can use the i18n view helper to prepend your routes in the desired
            language</p>
            <div class="code tl">&lt;a href="&lt;?= $this->l() ?&gt;/some/link">Some Link&lt;/a&gt;</div>
            <p class="text-muted">For more information, see <a target="_blank" href="//docs.laminas.dev/laminas-i18n/">
                    Laminas i18n</a>.</p>
            <p class="text-muted">We recommend <a href="https://poedit.net/">PoEdit</a> to manage your translations.
                <br>Configure it to look for <span class="code">t</span> and <span class="code">translate</span> in
                order for it to detect translation functions in your code base.
            </p>
        </div>
    </div>
</section>

<section id="logs" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted"><?= $this->t('logs'); ?></h2>
            <p class="text-muted">Bone uses <a href="//github.com/Seldaek/monolog">monolog/monolog</a>, and logs can be found in
                <span class="code">data/logs</span>. Currently we only support writing to files, but you can add as many
                channels as you like:
            </p>
            <div class="code tl"><pre>
&lt&lt;?php

return [
    'log' => [
        'channels' => [
            'default' => 'data/logs/default_log',
        ],
    ],
];
</pre></div>
            <p class="text-muted"><?= $this->t('learn.logs.usage'); ?></p>
            <div class="code tl">
                $this->getLog()->debug($message) // or error(), etc, see PSR-3
            </div>
        </div>
    </div>
</section>

<section id="cli" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h2 class="text-center pt20 text-muted">Command Line Interface</h2>
            <p class="text-muted">Bone Framework comes with a CLI command <span class="code">vendor/bin/bone</span>,
                which is powered by the <a href="//symfony.com/doc/current/components/console.html">Symfony Console</a>
                component. We recommend (for your convenience) to add the following to your <span class="code">
                    ~/.bash_profile</span></p>
            <code>export PATH=$PATH:bin:vendor/bin</code><br>&nbsp;<br>
            <p class="text-muted">This allows you to simply call <span class="code">bone</span> without the vendor path.</p>
            <div class="text-center">
                <img src="/img/bone_command.png" alt="The bone CLI command"/>
            </div>
            <br>
            <p class="text-muted">To register your own commands to bone, simply make your package class implement <br>
                <span class="code">Bone\Console\CommandRegistrationInterface</span>.</p>
            <div class="code tl"><pre>
&lt;?php

class SomePackage implements RegistrationInterface, CommandRegistrationInterface
{
    // other code here ...

    /**
     * @param Container $container
     * @return array
     */
    public function registerConsoleCommands(Container $container): array
    {
        // Create your command(s) first, then return in an array
        $someDependency = $c->get(SomeDependency::class);
        $swashbucklingCommand = new SwashbucklingCommand($someDependency);

        return [$swashbucklingCommand];
    }
}
</pre></div>
        </div>
    </div>
</section>

