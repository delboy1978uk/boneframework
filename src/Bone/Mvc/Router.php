<?php

namespace Bone\Mvc;

class Router
{
    private $controller;
    private $action;
    private $view;
    private $params;
    private $route;


    /**
     *  We be needin' t' look at th' map
     *  @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->route = $request->getURI();
        $this->controller = 'Controller';
        $this->action = 'index';
        $this->params = array();
        $this->view = false;
    }



    private function parseRoute()
    {
        // Has th'route been set?
        if (isset($this->route))
        {
            // which way be we goin' ?
            $path = $this->route;

            // we be checkin' our treasure map lookin' fer a route
            $routes = Registry::ahoy()->get('routes');

            // look fer feckin colon :variables in the defined route
            $mandatory_param = '/(\/:\w+)/';
            $optional_param = '/(\[\/:\w+\])/';
            $route_check = array();

            // check fer a match from the configgered routes?
            $x = 0;
            foreach($routes as $route => $options)
            {
                $route_check[$x] = array();
                $route_check[$x]['route'] = $route;
                $route_check[$x]['params'] = array(
                    'controller' => $options['controller'],
                    'action' => $options['action'],
                    'params' => $options['params'],
                );
                if(!strstr($route,':'))
                {
                    $route_check[$x]['matches'] = array($route);
                }

                //check fer optional variables in th' uri
                if (preg_match($optional_param, $route, $matches))
                {
                    foreach($matches as $match)
                    {
                        $route_check[$x]['matches'][] = str_replace($match,'',$route);
                    }
                    // now check fer optional
                    foreach($matches as $match)
                    {
                        $route_check[$x]['matches'][] = str_replace($match,$optional_param,$route);
                    }
                }

                //check fer mandatory variables in th' uri
                if (preg_match($mandatory_param, $route, $matches))
                {
                    foreach($matches as $match)
                    {
                        $r = str_replace($match,$optional_param,$route);
                        if(strstr($match,':'))
                        {
                            $route_check[$x]['matches'][] = $r;
                        }
                    }
                }
                $x ++;
            }


//            die(var_dump($route_check));
//                foreach($routes as $key => $val)
//                {
//                    echo print_r($key).'<br />&nbsp;&nbsp;'.print_r($val).'<br />';
//                }
//                die();
//                if (preg_match($replace, $route, $matches))
//                {
//                    foreach($matches as $match)
//                    {
//                        // turn the :variable part o' th' route int' some black magic voodoo regex
//                        $check = str_replace(':'.$match,$replace,$route);
//                        $replace_array[] = $check;
//                    }
//                }
//            }
//            echo '<hr />';
//
//
//
//            // feckin' voodoo black magic spells
//            // default t' either /controller/action/var/val/var/val/etc
//            $cavvv = '/^\/(?<controller>[^\/]+)\/(?<action>[^\/]+)\/(?<varvalpairs>(?:[^\/]+\/[^\/]+\/?)*)/';
//            // or /controller/action/id
//            $cai =  '/^([\w]+)\/([\w]+)\/([\d]+).*$/';
//
//            // we be listin' the matches in an array
//            $matches = array();
//
//            // default t't' index controller
//            if (empty($path)){$this->controller = 'index'; $this->action = 'index';}
//            elseif (preg_match($cavvv, $path, $matches))
//            {
//                die(var_dump($matches));
//                $this->controller = $matches[1];$this->action = $matches[2];$id = $matches[3];
//            }
//            elseif (preg_match($cai, $path, $matches))
//            {
//                $this->controller = $matches[1];
//                $this->action = $matches[2];
//                $id = $matches[3];
//            }
//
//            // get query string from url
//            $query = array();
//            $parse = parse_url($path);
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