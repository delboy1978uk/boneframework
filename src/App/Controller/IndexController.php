<?php

namespace App\Controller;

use Bone\Mvc\Controller;
use Bone\Mvc\Registry;
use Zend\Diactoros\Response;


class IndexController extends Controller
{
    private $locale;

    public function init()
    {
        $this->locale = $this->view->locale = $this->getParam('locale', Registry::ahoy()->get('i18n')['default_locale']);
        $this->getTranslator()->setLocale($this->locale);
    }

    public function indexAction()
    {
        if (!$this->getParam('locale')) {
            return new Response\RedirectResponse('/' . $this->locale);
        }
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
