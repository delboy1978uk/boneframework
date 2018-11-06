Bone MVC Framework
==================
[![Latest Stable Version](https://poser.pugx.org/delboy1978uk/bonemvc/v/stable)](https://packagist.org/packages/delboy1978uk/bonemvc) [![Total Downloads](https://poser.pugx.org/delboy1978uk/bonemvc/downloads)](https://packagist.org/packages/delboy1978uk/bonemvc) [![Latest Unstable Version](https://poser.pugx.org/delboy1978uk/bonemvc/v/unstable)](https://packagist.org/packages/delboy1978uk/bonemvc) [![License](https://poser.pugx.org/delboy1978uk/bonemvc/license)](https://packagist.org/packages/delboy1978uk/bonemvc)<br />
[![Build Status](https://travis-ci.org/delboy1978uk/bonemvc.png?branch=master)](https://travis-ci.org/delboy1978uk/bonemvc) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master)<br />
Be ye wantin an MVC framework peppered with local pirate lingo?<br />
It be the most bare bones framework in the seven seas!<br />
http://bonemvc.delboysplace.co.uk

Installation
------------
First make sure you have Composer! Then install Bone.
```
composer create-project delboy1978uk/bonemvc your/path/here
```
or if you haven't installed composer globally ...
```
php composer.phar create-project delboy1978uk/bonemvc your/path/here dev-master
```
### Docker Dev Box
Bone comes with a docker-compose.yml in the project, so you can instantly get a dev server running if you use Docker 
(Tested using a default VirtualBox VM). Just add this to your hosts file:
```
awesome.scot 192.168.99.100
```
`cd` into your project and run the ollowing:
```
docker-machine start 
eval $(docker-machine env) 
docker-compose up
```
Then you can access the site at `https://awesome.scot` in your browser. Of course if you don't use docker you can add it 
to your LAMP stack in the usual way.
### Permissions
Make the data folder writable. 777 gives everyone write access, so instead set it to 775 with yer Apache user in the group.
```
chmod -R 775 data
```
### Apache setup
In your Apache virtual hosts, set the document root as the public folder
```apacheconfig
<VirtualHost *:80>
    DocumentRoot "/var/www/bonemvc/public"
    ServerName dev.bonemvc.com
    ServerAdmin delboy1978uk@gmail.com
    ErrorLog "logs/error_log"
    SetEnv APPLICATION_ENV development
    <Directory "/var/www/bonemvc">
        DirectoryIndex index.php
        FallbackResource /index.php
        Options -Indexes +FollowSymLinks
        AllowOverride all
        Require all granted
    </Directory>
    BrowserMatch ".*MSIE.*" nokeepalive downgrade-1.0 force-response-1.0
</VirtualHost>
```
Config Folders
---------
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
    return [ 
        'i18n' => [ 
            'translations_dir' => 'data/translations', 
            'type' => \Zend\I18n\Translator\Loader\Gettext::class, 
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
#### routes
outes follow a default pattern of 
```
/controller/action/param1/value1/param2/value2/etc/etc
```
You can also override routes by defining them in the config array:

In the config.php ye can customise routes to go to certain controllers and actions like this:
```php
    'routes' => array(
        '/some-custom-url' => array(
            'controller' => 'index',
            'action' => 'index',
            'params' => array(
                'user' => 666,
                'skull => 'crossbones',
             ),
        ),
    ),
```
Ye can configure mandatory and optional paramaters in your routes like this:
```php
/my-route/:mandatory[/:optional]
```
In yer controller, ye would ask fer ```$this->getParam('mandatory');``` and ```$this->getParam('optional');```<br />

## Controllers
Make your controllers extend ```Bone\Mvc\Controller```, and name your controller actions like pirateAction() etc.<br />
To send data to the view, yo can either return an array, or call 
```php
$this->view->someVar = 'gaaarrrrr!';

// or
return [
    'someVar' => 'gaaarrrr!',    
];
```
You can also return a PSR-7 response.
#### init() and postDispatch()
Th' init(); and postDispatch() methods will run before and after your controller action does, so ye can do stuff in 
there too if need be!
#### JSON Content Type
Buildin' an API, aye? Ye can send ```application/json``` by callin' the followin' method in yer controller action:
```php
$this->sendJsonResponse($array);
```
#### HTTP Requests, Responses, and Headers
Bone be all shiny and new these days, and we be usin' PSR-7 Request and Response objects. Ye can get them using th' 
```getHeaders()``` method, or individual headers with the ```getHeader($key)``` method. ```$this->getRequest()``` be 
returnin' an instance of ```Psr\Http\Message\ServerRequestInterface```.
## Views
We pirates be luvvin' PHP, and as such v2.0.0 of Bone MVC has made Twig walk the plank! We now be using th' fantastic 
Plates (http://platesphp.com/). Anything ye send up t' th' view like ```$this->view->drink = 'grog';``` can be output
in the view by a simple:
```php
echo $drink;
```
Of course, ye be wantin' to escape your output too! So do it like this:
```php
echo $this->e($drink);
```
## Registry
Bone be usin' a Registry to store stuff in. Soon we'll be changin' that to use Barnacle, a plundered version of th' 
awesome Pimple dependency injection container. T' use it, just do the followin':
```php
use Bone\Mvc\Registry;

Registry::set('name' => 'Guybrush');
echo Registry::get('name'); // outputs 'Guybrush'
```
Ye can store whatever th' hell be needin' stored, objects, or whatever!
## Additional Libraries
Avast ye! We be usin' some additional libs by th' Cap'n (delboy1978uk), namely:
```
delboy1978uk/cdn
delboy1978uk/form
delboy1978uk/image
delboy1978uk/session
```
Fer the CDN lib, ye can quickly echo out javascript and css using ```Del\Cdn```, see ```App\View\layouts\layout.php``` fer an example.<br />
See also use ```Del\Icon``` and ```Del\Css```, which come as part of the cdn lib.<br />
Ye can create custom Bootstrap ready forms usin' ```delboy1978uk/form```, see the Github page fer details.<br />
Ye can manipulate images usin' the gd PHP functions, with the ```Del\Image``` class.
Ye can set Session variables usin' ```Del\SessionManager```, see GitHub for info.

#### Get Swashbucklin'! Gaarrrrr!
