<?php

namespace Bone\Db\Adapter;
use Bone\Db\Adapter\DbAdapterInterface;
use PDO;

abstract class AbstractDbAdapter implements DbAdapterInterface
{
    /**
     * @var PDO $connection
     */
    protected  $connection;
    private   $host;
    private   $database;
    private   $user;
    private   $pass;

    public function __construct($credentials)
    {
        $this->host = $credentials['host'];
        $this->database = $credentials['database'];
        $this->user = $credentials['user'];
        $this->pass = $credentials['pass'];
    }

    public abstract function openConnection();

    public abstract function closeConnection();

    public function isConnected()
    {
        // TODO: Implement isConnected() method.
    }

    public function executeQuery()
    {
        // TODO: Implement executeQuery() method.
    }

    public function getConnection()
    {
        if(!$this->connection)
        {
            $this->openConnection();
        }
        return $this->connection;
    }

    protected  function getDatabase()
    {
        return $this->database;
    }

    protected function getHost()
    {
        return $this->host;
    }

    protected function getPass()
    {
        return $this->pass;
    }

    protected function getUser()
    {
        return $this->user;
    }


}

