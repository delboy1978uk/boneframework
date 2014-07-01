<?php

namespace App\Controller;
use Bone\Mvc\Controller;
use Bone\Mvc\Exception;


class IndexController extends Controller
{
    public function indexAction()
    {

    }

    public function learnAction()
    {

    }

    public function jsonAction()
    {
        // example of a Json page
        $this->disableLayout();
        $this->disableView();
        $array = array(
          'Rum',
          'Grog'
        );
        $this->getHeaders()->setJsonResponse();
        $this->setBody(json_encode($array));
    }
}