<?php

namespace Bone\Mvc;
use Bone\Mvc\Router\Route;
use Bone\Regex;

class Router
{
    private $controller;
    private $action;
    private $params;
    private $routes;


    /**
     *  We be needin' t' look at th' map
     *  @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->uri = $request->getURI();
        $this->controller = 'index';
        $this->action = 'index';
        $this->params = array();
        $this->routes = array();
    }


    /**
     *  Figger out where we be goin'
     */
    private function parseRoute()
    {
        // which way be we goin' ?
        $path = $this->uri;

        // Has th'route been set?
        if (isset($path) && $path != '/')
        {


            // we be checkin' our instruction fer configgered routes
            $configgeration = Registry::ahoy()->get('routes');

            // stick some voodoo pins in the map
            foreach($configgeration as $route => $options)
            {
                // add the route t' the map
                $this->routes[] = new Route($route,$options);
            }

            // try an' match each route with th' uri
            $match = false;
            /** @var \Bone\Mvc\Router\Route $route */
            foreach($this->routes as $route)
            {
                if($route->getRegexStrings()[0] != '\/' && $matches = $route->checkRoute($this->uri))
                {
                    $match = true;
                    $this->controller = $route->getControllerName();
                    $this->action = $route->getActionName();
                    $this->params = $route->getParams();
                }
            }
            if(!$match)
            {
                /**
                 * not a configgered route then
                 * probably a standard controller/action/var/val/etc route then?
                 */
                $regex = new Regex(Regex\Url::CONTROLLER_ACTION_VARS);
                if($matches = $regex->getMatches($this->uri))
                {
                    $match = true;
                    $this->controller = $matches['controller'];
                    $this->action = $matches['action'];
                    $ex = explode('/',$matches['varvalpairs']);
                    for($x = 0; $x <= count($ex)-1 ; $x += 2)
                    {
                        $this->params[$ex[$x]] = $ex[$x+1];
                    }
                }
                if(!$match)
                {
                    $regex = new Regex(Regex\Url::CONTROLLER_ACTION);
                    if($matches = $regex->getMatches($this->uri))
                    {
                        $match = true;
                        $this->controller = $matches['controller'];
                        $this->action = $matches['action'];
                        $ex = explode('/',$matches['varvalpairs']);
                        for($x = 0; $x <= count($ex)-1 ; $x += 2)
                        {
                            $this->params[$ex[$x]] = $ex[$x+1];
                        }
                    }
                }
                if(!$match)
                {
                    $this->controller = 'error';
                    $this->action = 'not-found';
                }
            }
            echo $this->uri.'<br />';
            echo $this->controller.' controller and '.$this->action.' action.<br />';
            echo 'Params:';
            var_dump($this->params);


//
//            // if we have query string
//            if(!empty($parse['query']))
//            {
//                // parse query string
//                parse_str($parse['query'], $query);
//
//                // if query paramater is parsed
//                if(!empty($query))
//                {
//                    // merge the query parameters to $_GET variables
//                    $_GET = array_merge($_GET, $query);
//
//                    // merge the query parameters to $_REQUEST variables
//                    $_REQUEST = array_merge($_REQUEST, $query);
//                }
//            }
//        }
//        // gets the request method
//        $method = $_SERVER["REQUEST_METHOD"];
//
//        // assign params by methods
//        switch($method){
//            case "GET": // view
//                // we need to remove _route in the $_GET params
//                unset($_GET['_route']);
//                // merege the params
//                $this->params = array_merge($this->params, $_GET);
//                break;
//            case "POST": // create
//            case "PUT":  // update
//            case "DELETE": // delete
//            {
//                // ignore the file upload
//                if(!array_key_exists('HTTP_X_FILE_NAME',$_SERVER))
//                {
//                    if($method == "POST")
//                    {
//                        $this->_params = array_merge($this->params, $_POST);
//                    }
//                    else
//                    {
//                        // temp params
//                        $p = array();
//                        // the request payload
//                        $content = file_get_contents("php://input");
//                        // parse the content string to check we have [data] field or not
//                        parse_str($content, $p);
//                        // if we have data field
//                        $p = json_decode($content, true);
//                        // merge the data to existing params
//                        $this->params = array_merge($this->params, $p);
//                    }
//                }
//            }
//                break;
//        }
//        // set param id to the id we have
//        if(!empty($id)){
//            $this->params['id']=$id;
//        }
//
//        if($this->controller == 'index'){
//            $this->params = array($this->params);
        }
    }



    public function dispatch()
    {
        $this->parseRoute();
//        $controllerName = $this->_controller;
//        $model = $this->_controller.'Model';
//        $model = class_exists($model) ? $model : 'Model';
//        $this->_controller .= 'Controller';
//        $this->_controller = class_exists($this->_controller) ? $this->_controller : 'Controller';
//        $dispatch = new $this->_controller($model, $controllerName, $this->_action);
//        $hasActionFunction = (int)method_exists($this->_controller, $this->_action);
//
//        // we need to reference the parameters to a correct order in order to match the arguments order
//        // of the calling function
//        $c = new ReflectionClass($this->_controller);
//        $m = $hasActionFunction ? $this->_action : 'defaultAction';
//        $f = $c->getMethod($m);
//        $p = $f->getParameters();
//        $params_new = array();
//        $params_old = $this->_params;
//        // re-map the parameters
//        for($i = 0; $i<count($p);$i++){
//            $key = $p[$i]->getName();
//            if(array_key_exists($key,$params_old)){
//                $params_new[$i] = $params_old[$key];
//                unset($params_old[$key]);
//            }
//        }
//        // after reorder, merge the leftovers
//        $params_new = array_merge($params_new, $params_old);
//        // call the action method
//        $this->_view = call_user_func_array(array($dispatch, $m), $params_new);
//        // finally, we print it out
//        if($this->_view){
//            echo $this->_view;
//        }
        return new Response();
    }

}