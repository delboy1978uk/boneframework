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
        $array = array(
          'Rum' => 'tasty',
          'Grog' => 'the best!',
        );
        $this->sendJsonResponse($array);
    }
}
