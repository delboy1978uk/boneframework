<?php

namespace App\Controller;
use Bone\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo 'Hello World!<br />';
//        $query = $this->getDbAdapter()->query('select * from dogs');
//        $dogs = $query->fetchAll();
//        var_dump($dogs);
    }
}