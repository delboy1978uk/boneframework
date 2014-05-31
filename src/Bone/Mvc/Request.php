<?php

namespace Bone\Mvc;

class Request
{
    /**
     * This be a treasure chest of request data
     *
     * @var array
     */
    protected $_data = array();


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
        $this->_clean();
    }



    /**
     *  We be setting arrays here by key
     *
     * @param string $key
     * @param mixed $value
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
}