<?php

namespace Bone\Db\Adapter;
use PDO;

class MySQL extends AbstractDbAdapter
{
    public function openConnection()
    {
        $host = $this->getHost();
        $db = $this->getDatabase();
        $user = $this->getUser();
        $pass = $this->getPass();
        $this->connection = new PDO('mysql:host='.$host.';dbname='.$db, $user, $pass);
    }

    public function closeConnection()
    {
        unset($this->connection);
    }

}