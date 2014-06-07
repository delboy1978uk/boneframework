<?php

namespace Bone\Mvc;
use Bone\Db\Adapter\MySQL;

class Controller
{
    /**
     * @var Request
     */
    protected $_request;

    /**
     * @var \Bone\Db\Adapter\MySQL
     */
    protected $_db;

    public function __construct(Request $request)
    {
        $this->_request = $request;
        $config = Registry::ahoy()->get('db');
        $this->_db = new MySQL($config);
    }

    protected function getDbAdapter()
    {
        return $this->_db->getConnection();
    }
}