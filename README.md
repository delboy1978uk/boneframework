Bone MVC Framework
==================
[![Latest Stable Version](https://poser.pugx.org/delboy1978uk/bonemvc/v/stable)](https://packagist.org/packages/delboy1978uk/bonemvc) [![Total Downloads](https://poser.pugx.org/delboy1978uk/bonemvc/downloads)](https://packagist.org/packages/delboy1978uk/bonemvc) [![Latest Unstable Version](https://poser.pugx.org/delboy1978uk/bonemvc/v/unstable)](https://packagist.org/packages/delboy1978uk/bonemvc) [![License](https://poser.pugx.org/delboy1978uk/bonemvc/license)](https://packagist.org/packages/delboy1978uk/bonemvc)<br />
[![Build Status](https://travis-ci.org/delboy1978uk/bonemvc.png?branch=master)](https://travis-ci.org/delboy1978uk/bonemvc) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master)<br />
Be ye wantin an MVC framework peppered with local pirate lingo?<br />
It be the most bare bones framework in the seven seas!<br />
http://bonemvc.delboysplace.co.uk

Installation
------------
composer create-project delboy1978uk/bonemvc your/path/here <br />
### Apache setup
We don't need tellin' ye, t' be sure, but a typical Apache vhost settin' might be lookin' like this:
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
Project Folders
---------
### config
Garr! In the config folder be yer main config.php, and ye can have as many other config files (*.php) as ye want in a 
folder with th' same name as th' environment variable `APPLICATION_ENV`.  Just get each file to return an array.
#### routes
Th' default route matchin' system follows the followin' pattern:
```
/controller/action/param1/value1/param2/value2/etc/etc
```
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
#### db
Ye can connect to a MySQL database by puttin' yer connection details in th' config<br />
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
### templates
Ye can put a master template in here. Bone be lookin' in App\View\layouts fer a PHP file by th' same name.
```php
    'templates' => array(
        'layout'
    ),
```
Be checkin' th' folder fer an example!
### config.dev.php.dist
This be a config which can override th' production settin's. Remove the .dist extension, and ye can add details for your dev environment. 
## Controllers
Make yer controller extend ```Bone\Mvc\Controller```, and name your controller actions like pirateAction() etc.<br />
T' send data t' th' view, ye can either return an array, or call 
```php
$this->view->someVar = 'gaaarrrrr!';

// or
return [
    'someVar' => 'gaaarrrr!',    
];
```
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
