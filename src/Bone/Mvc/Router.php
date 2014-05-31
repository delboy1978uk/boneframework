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
     *  @param $route
     */
    public function __construct($route)
    {
        $this->route = $route;
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
            // which way be we goin' ?www
            $path = $this->route;

            // voodoo black magic spells
            $cai =  '/^([\w]+)\/([\w]+)\/([\d]+).*$/';  //  controller/action/id
            $ci =   '/^([\w]+)\/([\d]+).*$/';           //  controller/id
            $ca =   '/^([\w]+)\/([\w]+).*$/';           //  controller/action
            $c =    '/^([\w]+).*$/';                    //  action
            $i =    '/^([\d]+).*$/';                    //  id

            // we be listin' the matches in an array
            $matches = array();

            // default t't' index controller
            if (empty($path)){$this->controller = 'index'; $this->action = 'index';}
            else if (preg_match($cai, $path, $matches)){$this->controller = $matches[1];$this->action = $matches[2];$id = $matches[3];}
            else if (preg_match($ci, $path, $matches)){$this->controller = $matches[1];$id = $matches[2];}
            else if (preg_match($ca, $path, $matches)){$this->controller = $matches[1];$this->action = $matches[2];}
            else if (preg_match($c, $path, $matches)){$this->controller = $matches[1];$this->action = 'index';}
            else if (preg_match($i, $path, $matches)){$id = $matches[1];}

            // get query string from url
            $query = array();
            $parse = parse_url($path);

            // if we have query string
            if(!empty($parse['query']))
            {
                // parse query string
                parse_str($parse['query'], $query);

                // if query paramater is parsed
                if(!empty($query))
                {
                    // merge the query parameters to $_GET variables
                    $_GET = array_merge($_GET, $query);

                    // merge the query parameters to $_REQUEST variables
                    $_REQUEST = array_merge($_REQUEST, $query);
                }
            }
        }
        // gets the request method
        $method = $_SERVER["REQUEST_METHOD"];

        // assign params by methods
        switch($method){
            case "GET": // view
                // we need to remove _route in the $_GET params
                unset($_GET['_route']);
                // merege the params
                $this->_params = array_merge($this->_params, $_GET);
                break;
            case "POST": // create
            case "PUT":  // update
            case "DELETE": // delete
            {
                // ignore the file upload
                if(!array_key_exists('HTTP_X_FILE_NAME',$_SERVER))
                {
                    if($method == "POST"){
                        $this->_params = array_merge($this->_params, $_POST);
                    }else{
                        // temp params
                        $p = array();
                        // the request payload
                        $content = file_get_contents("php://input");
                        // parse the content string to check we have [data] field or not
                        parse_str($content, $p);
                        // if we have data field
                        $p = json_decode($content, true);
                        // merge the data to existing params
                        $this->_params = array_merge($this->_params, $p);
                    }
                }
            }
                break;
        }
        // set param id to the id we have
        if(!empty($id)){
            $this->_params['id']=$id;
        }

        if($this->_controller == 'index'){
            $this->_params = array($this->_params);
        }
    }
}