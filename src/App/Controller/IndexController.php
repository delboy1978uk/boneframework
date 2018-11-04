<?php

namespace App\Controller;

use AspectMock\Test;
use Bone\Mvc\Controller;
use Bone\Mvc\Dispatcher;
use Bone\Mvc\Registry;
use Bone\Mvc\View\PlatesEngine;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\TextResponse;


class IndexController extends Controller
{
    public function init()
    {
        $locale = $this->getParam('locale') ?: Registry::ahoy()->get('i18n')['default_locale'];
        $this->getTranslator()->setLocale($locale);
    }

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
