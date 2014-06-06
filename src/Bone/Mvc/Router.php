<?php

namespace Bone\Mvc;
use Bone\Mvc\Router\Route;
use Bone\Regex;

class Router
{
    private $request;
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
        $this->request = $request;
        $this->uri = $request->getURI();
        $this->controller = 'index';
        $this->action = 'index';
        $this->params = array();
        $this->routes = array();

        // get th' path 'n' query string from url
        $parse = parse_url($this->uri);
        $this->uri = $parse['path'];

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
                // if the regex ain't for the home page an' it matches our route
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
                    // we have a controller action var val match Cap'n!
                    // settin' the destination controller and action and params
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
                        // we have a controller action match Cap'n!
                        // settin' the destination controller and action and params
                        $match = true;
                        $this->controller = $matches['controller'];
                        $this->action = $matches['action'];

                    }
                }
                if(!$match)
                {
                    // theres nay route that matches cap'n
                    // settin' the destination controller and action and params
                    $this->controller = 'error';
                    $this->action = 'not-found';
                }
            }



            // what type o' request is the request sendin' ?
            $method = $this->request->getMethod();

            // assign params by methods
            switch($method)
            {
                case "GET": // view
                    $this->params = array_merge($this->params, $this->request->getGet());
                    break;
                case "POST": // create
                case "PUT":  // update
                case "DELETE": // delete
                {
                    // ignore the file upload
                    if(!array_key_exists('HTTP_X_FILE_NAME',$_SERVER))
                    {
                        if($method == "POST")
                        {
                            $this->_params = array_merge($this->params, $this->request->getPost());
                            $this->_params = array_merge($this->params, $this->request->getGet());
                        }
                        else
                        {
                            // temp params
                            $p = array();
                            $content = file_get_contents("php://input");
                            parse_str($content, $p);
                            $p = json_decode($content, true);
                            $this->params = array_merge($this->params, $p);
                        }
                    }
                }
                    break;
            }
            echo $this->uri.'<br />';
            echo $this->controller.' controller and '.$this->action.' action.<br />';
            echo 'Params:';
            var_dump($this->params);
        }
    }



    public function dispatch()
    {
        $this->parseRoute();
        $controller = ucwords($this->controller).'Controller';
        if(!class_exists($controller))
        {
            $this->controller ='ErrorController';
            $this->action = 'errorAction';
        }
        else
        {
            $dispatch = new $this->controller;
            if(!method_exists($dispatch,$this->action))
            {
                $this->controller = 'ErrorController';
                $this->action = 'errorAction';
                $dispatch = new $this->controller;
            }
        }



        $this->request->setController($controller);
        $this->request->setAction($this->action);
        $this->request->setParams($this->params);

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