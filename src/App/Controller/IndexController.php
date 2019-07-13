<?php

namespace App\Controller;

use Bone\Http\Response;
use Bone\Mvc\OldController;
use Bone\Mvc\View\ViewEngine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
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

    /** @var ViewEngine $view */
    private $view;

    /**
     * DragonController constructor.
     */
    public function __construct(ViewEngine $view)
    {
        $this->view = $view;
    }

    public function init()
    {
        $this->locale = $this->view->locale = $this->getParam('locale', Registry::ahoy()->get('i18n')['default_locale']);
        $this->getTranslator()->setLocale($this->locale);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function indexAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $body = $this->view->render('index/index');

        return new HtmlResponse($body);
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface
     */
    public function learnAction(ServerRequestInterface $request, array $args) : ResponseInterface
    {
        $body = $this->view->render('index/learn');

        return new HtmlResponse($body);
    }
}
