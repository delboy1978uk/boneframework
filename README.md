Bone MVC Framework
==================
[![Build Status](https://travis-ci.org/delboy1978uk/bonemvc.png?branch=master)](https://travis-ci.org/delboy1978uk/bonemvc) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=master) master<br />
[![Build Status](https://travis-ci.org/delboy1978uk/bonemvc.png?branch=dev-master)](https://travis-ci.org/delboy1978uk/bonemvc) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/coverage.png?b=dev-master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=dev-master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/badges/quality-score.png?b=dev-master)](https://scrutinizer-ci.com/g/delboy1978uk/bonemvc/?branch=dev-master) dev-master

Be ye wantin an MVC framework peppered with local pirate lingo?<br />
It be the most bare bones framework in the seven seas!<br />
http://bonemvc.delboysplace.co.uk

Installation
------------
composer create-project delboy1978uk/bonemvc your/path/here dev-master<br />
###Apache setup
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
###config
Garr! In the config folder be two files, config.php, and config.dev.php.dist.
####routes
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
####db
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
###templates
Ye can put a master template in here. Bone be lookin' in App\View\layouts fer a PHP file by th' same name.
```php
    'templates' => array(
        'layout'
    ),
```
Be checkin' th' folder fer an example!
###config.dev.php.dist
This be a config which can override th' production settin's. Remove the .dist extension, and ye can add details for your dev environment. 
##Controllers
Make yer controller extend ```Bone\Mvc\Controller```, and name your controller actions like pirateAction() etc.<br />
T' send data t' th' view, ye can either return an array, or call 
```php
$this->view->someVar = 'gaaarrrrr!';

// or
return [
    'someVar' => 'gaaarrrr!',    
];
```
####init() and postDispatch()
Th' init(); and postDispatch() methods will run before and after your controller action does, so ye can do stuff in 
there too if need be!
####HTTP Requests, Responses, and Headers
Bone be all shiny and new these days, and we be usin' PSR-7 Request and Response objects. Ye can get them using th' 
```getHeaders()``` method, or individual headers with the ```getHeader($key)``` method. ```$this->getRequest()``` be 
returnin' an instance of ```Psr\Http\Message\ServerRequestInterface```.
##Registry
Bone be usin' a Registry to store stuff in. Soon we'll be changin' that to use Barnacle, a plundered version of th' 
awesome Pimple dependency injection container. T' use it, just do the followin':
```php
use Bone\Mvc\Registry;

Registry::set('name' => 'Guybrush');
echo Registry::set('name'); // outputs 'Guybrush'
```
Ye can store whatever th' hell be needin' stored, objects, or whatever!
####Get Swashbucklin'! Gaarrrrr!
