<?php

namespace Bone\Mvc;

class Request
{
    /**
     * This be a treasure chest of request data
     *
     * @var array
     */
    public $_data = array();


    /**
     * here be the $_POST super global
     *
     * @var array
     */
    protected $_post = array();


    /**
     * garrr! and the $_GET super global
     *
     * @var array
     */
    protected $_get = array();


    /**
     * If yer hungry this is where ye find th' $_COOKIE super global
     *
     * @var array
     */
    protected $_cookie = array();


    /**
     * This be the uri of the address
     *
     * @var string
     */
    protected $_request_uri;

    private $controller;
    private $action;
    private $params;



    /**
     *  Cap'n! Incoming vessel!
     *                   Garrrr! What ship?
     *  It be the HTTP Request Cap'n!
     *                   Blustering barnacles, Prepare th' crew!
     *  Aye aye, cap'n!
     */
    public function __construct()
    {
        $this->_data = array_merge($this->_data, $_REQUEST);
        $this->_get = array_merge($this->_get, $_GET);
        $this->_post = array_merge($this->_post, $_POST);
        $this->_cookie = array_merge($this->_cookie, $_COOKIE);
        $this->_request_uri = $_SERVER['REQUEST_URI'];
        $this->_clean();
    }


    /**
     * We be setting arrays here by key
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $this->_data[$key] = $value;
    }


    /**
     * What be the value of this here key?
     *
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }



    /**
     * Allow access to data stored in GET, POST and COOKIE super globals.
     *
     * @param string $var
     * @param string $key
     * @return mixed
     */
    public function getRawData($var, $key)
    {
        switch(strtolower($var)) {
            case 'get':
                $array = $this->_get;
                break;

            case 'post':
                $array = $this->_post;
                break;

            case 'cookie':
                $array = $this->_cookie;
                break;

            default:
                $array = array();
                break;
        }

        if(isset($array[$key])) {
            return $array[$key];
        }
        return null;
    }

    /**
     * Internally clean request data by handling magic_quotes_gpc and then adding slashes.
     *
     */
    protected function _clean()
    {
        if(get_magic_quotes_gpc()) {
            $this->_data = $this->_stripSlashes($this->_data);
            $this->_post = $this->_stripSlashes($this->_post);
            $this->_get = $this->_stripSlashes($this->_get);
        }
    }

    /**
     * Strip slashes code from php.net website.
     *
     * @param mixed $value
     * @return array
     */
    protected function _stripSlashes($value)
    {
        if(is_array($value)) {
            return array_map(array($this,'_stripSlashes'), $value);
        } else {
            return stripslashes($value);
        }
    }

    /**
     *  Where th' feck are we?
     *
     * @return string
     */
    public function getURI()
    {
        return $this->_request_uri;
    }

    /**
     *  We be wantin' the GET variables
     * @return array
     */
    public function getGet()
    {
        return $this->_get;
    }


    /**
     *  We be wantin' the POST variables
     * @return array
     */
    public function getPost()
    {
        return $this->_post;
    }


    /**
     *  Set the action name
     * @param $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Give us the action name ya scurvy seadog
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * set the controls for th' heart of the sun
     *
     * @param $controller
     * @return $this
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }


    /**
     *   What be the controller we have?
     */
    public function getController()
    {
        return $this->controller;
    }


    /**
     * set th' params
     * @param $params
     * @return $this
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function setParam($key, $value)
    {
        $this->params[$key] = $value;
        return $this;
    }


    /**
     * give us th' params
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * give us th' params
     * @param param
     */
    public function getParam($key)
    {
        return $this->params[$key];
    }



    /**
     * What type o' request be we havin' here?
     * @return mixed
     */
    public function getMethod()
    {
        return $_SERVER["REQUEST_METHOD"];
    }
}