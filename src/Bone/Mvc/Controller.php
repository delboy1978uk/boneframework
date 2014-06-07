<?php

namespace Bone\Mvc;
use Bone\Db\Adapter\MySQL;
use Twig_Loader_Filesystem;
use Twig_Environment;
use stdClass;

class Controller
{
    /**
     * @var Request
     */
    protected $_request;

    protected $_twig;

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
        $this->_twig = new Twig_Environment($loader);
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
        return $this->_request->getParams();
    }

    /**
     *  runs after yer work is done
     */
    public function postDispatch()
    {
        // extend this t' run code after yer controller is finished
    }
}