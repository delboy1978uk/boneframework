<?php

namespace Bone\Mvc;
use Bone\Db\Adapter\MySQL;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extension_Debug;
use stdClass;
use \Exception;

class Controller
{
    /**
     * @var Request
     */
    protected $_request;

    protected $_twig;

    protected $controller;

    protected $action;

    public $view;

    /**
     * @var \Bone\Db\Adapter\MySQL
     */
    protected $_db;

    public function __construct(Request $request)
    {
        $this->_request = $request;
        $config = Registry::ahoy()->get('db');
        $this->_db = new MySQL($config);
        $loader = new Twig_Loader_Filesystem(APPLICATION_PATH.'/src/App/View/');
        $this->_twig = new Twig_Environment($loader,array('debug' => true));
        $this->_twig->addExtension(new Twig_Extension_Debug());
        $this->view = new stdClass();
    }

    /**
     * @return \PDO
     */
    protected function getDbAdapter()
    {
        return $this->_db->getConnection();
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->_twig;
    }


    /**
     *  runs before th' controller action
     */
    public function init()
    {
        // extend this t' initialise th' controller
    }

    public function getParams()
    {
        return new stdClass($this->_request->getParams());
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getParam($param)
    {
        return $this->_request->getParam($param);
    }

    /**
     *  runs after yer work is done
     */
    public function postDispatch()
    {
        // extend this t' run code after yer controller is finished
    }

}