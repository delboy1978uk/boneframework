<?php

namespace Bone\Mvc\Db\Adapter;

abstract class AbstractDbAdapter implements \DbAdapterInterface
{
    private $connection;
    private $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    public function openConnection()
    {
        // TODO: Implement openConnection() method.
    }

    public function closeConnection()
    {
        // TODO: Implement closeConnection() method.
    }

    public function isConnected()
    {
        // TODO: Implement isConnected() method.
    }

    public function executeQuery()
    {
        // TODO: Implement executeQuery() method.
    }
}

