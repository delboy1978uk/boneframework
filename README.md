# bone framework
[![Latest Stable Version](https://poser.pugx.org/delboy1978uk/boneframework/v/stable)](https://packagist.org/packages/delboy1978uk/boneframework) [![Total Downloads](https://poser.pugx.org/delboy1978uk/bone/downloads)](https://packagist.org/packages/delboy1978uk/boneframework) [![Latest Unstable Version](https://poser.pugx.org/delboy1978uk/boneframework/v/unstable)](https://packagist.org/packages/delboy1978uk/boneframework) [![License](https://poser.pugx.org/delboy1978uk/boneframework/license)](https://packagist.org/packages/delboy1978uk/boneframework)<br />
![build status](https://github.com/delboy1978uk/boneframework/actions/workflows/master.yml/badge.svg) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/boneframework/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/boneframework/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/boneframework/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/boneframework/?branch=master)<br />
Be ye wantin a PHP framework peppered with local pirate lingo?<br />
It be the most fearsome framework in the seven seas!<br />
http://boneframework.delboysplace.co.uk

## features
- PSR-7 http messaging 
- PSR-11 dependency injection container configuration
- PSR-15 middleware routing
- i18n translator
- Self contained package based architecture
- Built in optional Docker dev environment 
- Extendable Command Line Interface

## installation
#### via composer
We recommend using the bundled Docker environment, however you can use your own set up, see the `build/` folder for more
details on our default VirtualHost config etc. If you already have a setup, install via composer:
```
composer create-project delboy1978uk/boneframework your/path/here
```
#### via docker
The Docker dev environment saves you from all the usual devops nonsense. You can add `awesome.scot` to your `/etc/hosts` 
to `127.0.0.1`. Clone `delboy1978uk/lamp`, then replace the code folder `delboy1978uk/boneframework`, then start it up.
```
git clone https://github.com/delboy1978uk/lamp myproject
cd myproject
rm -fr code
git clone https://github.com/delboy1978uk/boneframework code
docker-compose up
```
Then browse to `https://awesome.scot`, and you will see the site running.

The development also has Mailhog running at `https://awesome.scot:8025`, so you can configure any dev emails to use 
SMTP port `1025` and all outgoing mails will appear in the Mailhog outbox.

MariaDB is running, on host `mariadb` (see `docker-compose.yml`), and `config/bone-db.php`).

To "SSH" into your server in order to run PHP commands like composer etc, type the following in a fresh terminal window
(remember on Windows & Mac you also need to run `eval $(docker-machine env)` to import the environment vars)
```
docker-compose exec php /bin/bash
```
To shut down your server, CTRL-C out, then type `docker-compose down`.
## a quick introduction to bone framework
#### skeleton project files
There are a few folders and files in your project, here's a quick description:
- config (Configuration for your application)
- data (Files your project will use (translations, cache, uploads, etc))
- public (The usual index.php endpoint and front end assets like css and images and js)
- src (Your application ackages live in here)
- tests (Because it's nice knowing your code works)
- vendor (Third party composer libs, don't edit, don't commit!)
#### bone framework application cycle
Upon launching Bone Framework (`public/index.php`), the application does a few things:
- Starts a session
- Loads the config from the config folder (different folders for different environments can be used)
- Registers bone framework core packages
- Registers packages from the `config/packages.php` into the DI container
- Adds any site wide middleware configured in `config/middleware.php`
- Dispatches a Request, returns a Response
## config
You can drop in any number of .php files into the config/ folder. Make sure they return an array with the config . You 
can override configuration based on environment var APPLICATION_ENV, so for instance if the environment was production 
it would load the additional config the production subdirectory.

There are several config files by default:
```
bone-db.php 
bone-firewall.php 
bone-i18n.php 
bone-log.php 
layouts.php 
middleware.php 
packages.php
paginator.php
paths.php
site.php
views.php
```
In your config files, you can add anything you want. 
## the package class
Packages are a key component in a Bone Framework application. You will see in the `config/packages.php`
which Packages are currently running on the framework. Take note that the order is important,
as packages may have a dependency which it needs defined from another package. Have a look inside 
`src/App/AppPackage.php`:
```php
<?php

namespace Bone\App;

use Bone\App\Controller\IndexController;
use Bone\Controller\Init;
use Bone\Router\Router;
use Bone\Router\RouterConfigInterface;
use Barnacle\RegistrationInterface;
use Barnacle\Container;

class AppPackage implements RegistrationInterface, RouterConfigInterface
{
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

    /**
     * @param Container $c
     * @param Router $router
     * @return Router
     */
    public function addRoutes(Container $c, Router $router): Router
    {
        $router->map('GET', '/', [IndexController::class, 'indexAction']);
        $router->map('GET', '/learn', [IndexController::class, 'learnAction']);

        return $router;
    }
}
```
You will see two methods, which are implementations of `RegistrationInterface` and `RouterConfigInterface`.
See the `league/route` docs on usage of the router. In the `addToContainer()` method, you can create factories for
your controllers and other dependencies.
## controllers
You will notice in the above App package that the factory for the controller returns `Controller::init($controller, $c)`.
This is a convenient initialisation class that will setup a few things into your class. To make things real easy, here's
all you need to do for each component:

- View Engine (implement `Bone\View\ViewAwareInterface` and use `Bone\View\Traits\HasViewTrait`)
- Translator (implement `Bone\I18n\I18nAwareInterface` and use `Bone\I18n\Traits\HasTranslatorTrait`)
- Site Config (implement `Bone\Server\SiteConfigAwareInterface` and use `Bone\Server\Traits\HasSiteConfigTrait`)
- Session (implement `Bone\Server\SessionAwareInterface` and use `Bone\Server\HasSessionTrait`)
- Logger (implement `Bone\Log\LoggerAwareInterface` and use `Bone\Log\HasLoggerTrait`)

You can also choose to extend `Bone\Controller\Controller`, which will give you a  view, translator, and site config 
immediately.
#### controller action methods
You can see the configured routes in the package class, and which controller class and method to call. Each action 
method is essentially a PSR-15 Server Request Handler Interface `https://www.php-fig.org/psr/psr-15/`. See 
`src/App/Controller/IndexController.php` for a basic example.

## db
Set your default db credentials in the main config/bone-db.php, and any environment specific configs in a subdirectory
```php
    'db' => array(
        'host' => '127.0.0.1',
        'database' => 'bone',
        'user' => 'leChuck',
        'pass' => 'bigWh00p',
    ),
```
In your package class, you can gert the connection from the container using `$c->get(PDO::class)`.

## i18n
Bone supports translation into different locales. Translation files (gettext `.po` and `.mo`) should be placed in 
`data/translations`, under a subdirectory of the locale, eg `data/translations/en_GB/en_GB.po`. You can set the default 
locale and an array of supported locales.
```php
<?php 

    use Laminas\I18n\Translator\Loader\Gettext;

    return [ 
        'i18n' => [ 
            'translations_dir' => 'data/translations', 
            'type' => Gettext::class, 
            'default_locale' => 'en_PI', 
            'supported_locales' => ['en_PI', 'en_GB', 'nl_BE', 'fr_BE'], 
        ], 
    ];
```
To use the translator, you can simply call:
```php
<?php
// from a controller: 
$this->getTranslator()->translate('placeholder.string'); 
// to set locale
$this->getTranslator()->setLocale($locale);
// from a view file:
$this->t('placeholder');
```
You can also set a supported locale into any URL, it will be stripped off the request and the locale set.
For example, if you have an endpooint `/morte/info`, you can make it `/nl_BE/more/info` or whatever, your route will
still resolve but now the locale will be the one you set. You can call `$this->l()` in a view file, to generate this 
first part of your url.
## logs
Bone uses monolog/monolog, and logs can be found in data/logs. Currently we only support writing to files, but you can 
add as many channels as you like:
```php
<?php 
return [ 
    'log' => [ 
        'channels' => [ 
            'default' => 'data/logs/default_log', 
        ], 
    ], 
];
```
To use the logger in a controller:
```php
$this->getLogger()->debug($message) // or error(), etc, see PSR-3
```
## recommended packages 
Bone Framework has a variety of packages already extending the framework further. Give these a try!
- `delboy1978uk/bone-form` - Generate forms, handle errors, i18n compatible
- `delboy1978uk/bone-doctrine` - A Doctrine Entity Manger 
- `delboy1978uk/bone-mail` - Mail functionality for Bone Framework
- `delboy1978uk/bone-user` - Full user registration system including activation emails etc
- `delboy1978uk/generator` - Generate new package templates quickly
- `delboy1978uk/bone-oauth2` - OAuth2 Authorization and Resource Server
- `delboy1978uk/bone-open-api` - Open API Swagger documentation
- `delboy1978uk/image` - An easy image class based on `gd`


#### get swashbucklin'! gaarrrrr!








