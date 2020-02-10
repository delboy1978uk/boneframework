Bone MVC Framework
==================
[![Latest Stable Version](https://poser.pugx.org/delboy1978uk/bonemvc/v/stable)](https://packagist.org/packages/delboy1978uk/bonemvc) [![Total Downloads](https://poser.pugx.org/delboy1978uk/bone/downloads)](https://packagist.org/packages/delboy1978uk/bonemvc) [![Latest Unstable Version](https://poser.pugx.org/delboy1978uk/bonemvc/v/unstable)](https://packagist.org/packages/delboy1978uk/bonemvc) [![License](https://poser.pugx.org/delboy1978uk/bonemvc/license)](https://packagist.org/packages/delboy1978uk/bonemvc)<br />
[![Build Status](https://travis-ci.org/delboy1978uk/bonemvc.png?branch=master)](https://travis-ci.org/delboy1978uk/bonemvc) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master)<br />
Be ye wantin an MVC framework peppered with local pirate lingo?<br />
It be the most bare bones framework in the seven seas!<br />
http://bonemvc.delboysplace.co.uk

Bone now be on v3.x! The entire deign o' th' ship has been streamlined and be far more manoeuvrable!
We be usin' a PSR-11 dependency injection container, coupled with a PSR-15 middleware router, in a modular manner! 
Jump on board! 

## installation
First make sure you have Composer! Then install Bone.
```
composer create-project delboy1978uk/bonemvc your/path/here
```
or if you haven't installed composer globally ...
```
php composer.phar create-project delboy1978uk/bonemvc your/path/here 
```
See below for information on how to get a complete dev server using Docker

## config
You can drop in any number of .php files into the config/ folder. Make sure they return an array with the config . You 
can override configuration based on environment var APPLICATION_ENV, so for instance if the environment was production 
it would load the additional config the production subdirectory.

There are several config files by default:
```
db.php 
i18n.php 
logs.php 
mail.php 
routes.php 
templates.php
```
In your config files, you can add anything you want. It gets stored in the Bone\Mvc\Registry.
#### db
Set your default db credentials in the main config/db.php, and any environment specific configs in a subdirectory
```php
    'db' => array(
            'host' => '127.0.0.1',
            'database' => 'bone',
            'user' => 'leChuck',
            'pass' => 'bigWh00p',
    ),
```
Then in yer controller, ye can get a PDO connection by saying:
```php
$this->getDbAdapter();
```
#### internationalisation
Bone supports translation into different locales. Translation files (gettext `.po` and `.mo`) should be placed in 
`data/translations`, under a subdirectory of the locale, eg `data/translations/en_GB/en_GB.po`. You can set the default 
locale and an array of supported locales.
```php
<?php 

    use Zend\I18n\Translator\Loader\Gettext;

    return [ 
        'i18n' => [ 
            'translations_dir' => 'data/translations', 
            'type' => Gettext::class, 
            'default_locale' => 'en_PI', 
            'supported_locales' => ['en_PI', 'en_GB', 'nl_BE', 'fr_BE'], 
        ], 
    ];
```
To use the translator, you can simply call:To use the translator, you can simply call:
```php
<?php
// from a controller: 
$this->getTranslator()->translate('placeholder.string'); 
// to set locale
$this->getTranslator()->setLocale($locale);
// from a view file:
$this->t('placeholder');
```
#### logs
Bone uses monolog/monolog, and logs can be found in data/logs.Currently we only support writing to files, but you can 
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
$this->getLog()->debug($message) // or error(), etc, see PSR-3
```
#### mail
Bone uses Zend Mail. To configure the mail client, just drop in your config (see zend mail docs)
```php
<?php 
return [ 
    'mail' => [ 
        'name' => '127.0.0.1', 
        'host' => 'localhost', 
        'port' => 25, 
     // 'connection_class' => 'login', // plain, login, crammd5
     // 'connection_config' => [
     //     'username' => 'user',
     //     'password' => 'pass',
     //  ],
    ], 
];
```
If you are using the Docker Box provided by bone, you also have the awesome MailHog at your disposal. Browse to 
awesome.scot:8025 and you'll see a catch all email inbox, so you never need to worry about development emails reaching the real world.

## modules and packages
Modules can be created in your `src/` folder. The default module is `BoneMvc\Module\App\AppPackage`.
Modules are enabled by adding them in `config/packages.php`. Vendor packages can also be installed via composer and enabled
in the same way.

### the module package class
A module at the very least will implement `Barnacle\RegistrationInterface`, and if it is an MVC module containing routes 
then it should also implement `Bone\Mvc\Router\RouterConfigInterface`. There are four methods in all to implement:
- `hasEntityPath(): bool`, if your module uses doctrine entities return true (requires `delboy1978uk/bone-doctrine` package)
- `getEntityPath(): string`, if you return true, this is the folder your entity class resides.
- `addToContainer(Container $c)`, described below
- `addRoutes(Container $c, Router $router): Router`, described below
#### addToContainer(Container $c)
You can create factories for your classes and otherwise initialise anythiung required elsewhere in your app.
As an example, a Controller class may wish to have the view Engine injected in, so in the method you would add the following:
```php
$c[MyController::class] = $c->factory(function (Container $c) {
    $view = $c->get(PlatesEngine::class);
    return new MyController($view);
});
```
The dependency injection container is `delboy1978uk/barnacle`, which is essentially Pimple extended and implementing PSR-11. 
#### addRoutes(Container $c)
Bone MVC uses `league/route`, a PSR-15 middleware library. Routes are added in your package like so:
```php
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
```
See their docs for more info on router usage
## additional libraries
Avast ye! We be usin' some additional libs by th' Cap'n (delboy1978uk), namely:
```
delboy1978uk/cdn
delboy1978uk/form
delboy1978uk/generator
delboy1978uk/image 
delboy1978uk/session
```
Fer the CDN lib, ye can quickly echo out javascript and css using ```Del\Cdn```, see ```App\View\layouts\bonemvc.php``` fer an example.<br />

See also use ```Del\Icon``` and ```Del\Css```, which come as part of the cdn lib.<br />

Ye can create custom Bootstrap ready forms usin' ```delboy1978uk/form```, see the Github page fer details.<br />

Ye can quickly make a new module usin' th' generator CLI command.

Ye can manipulate images usin' th' gd PHP functions, with the ```Del\Image``` class.

Ye can set Session variables usin' ```Del\SessionManager```, see GitHub for info.

#### get swashbucklin'! gaarrrrr!








