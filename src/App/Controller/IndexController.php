<?php

namespace App\Controller;

use Bone\Http\Response;
use Bone\Mvc\OldController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Stream;

/**
 * Class IndexController
 *
 * If you need to create a constructor, edit the package to set up automatically via dependency injection
 *
 * @package App\Controller
 */
class IndexController
{
    private $locale;

    public function init()
    {
        $this->locale = $this->view->locale = $this->getParam('locale', Registry::ahoy()->get('i18n')['default_locale']);
        $this->getTranslator()->setLocale($this->locale);
    }

    public function indexAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $response = new Response();
        $stream = new Stream('php://memory', 'r+');

        $test = ['message' => 'success'];

        $stream->write(json_encode($test));
        $response = $response->withBody($stream);
        return $response;
    }

    public function learnAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        return new Response();
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
