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
        $this->view = false; // the initial view
    }



    private function parseRoute()
    {
        // Has th'route been set?
        if (isset($this->route))
        {
            // the request path
            $path = $this->route;

            // the rules to route
            $cai =  '/^([\w]+)\/([\w]+)\/([\d]+).*$/';  //  controller/action/id
            $ci =   '/^([\w]+)\/([\d]+).*$/';           //  controller/id
            $ca =   '/^([\w]+)\/([\w]+).*$/';           //  controller/action
            $c =    '/^([\w]+).*$/';                    //  action
            $i =    '/^([\d]+).*$/';                    //  id

            // initialize the matches
            $matches = array();

            // if this is home page route
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
    }
}