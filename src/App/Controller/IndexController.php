<?php

namespace App\Controller;

use Bone\Mvc\View\ViewEngine;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class IndexController
 *
 * If you need to create a constructor, edit the package to set up automatically via dependency injection
 *
 * @package App\Controller
 */
class IndexController
{

    /** @var ViewEngine $view */
    private $view;

    /**
     * DragonController constructor.
     */
    public function __construct(ViewEngine $view)
    {
        $this->view = $view;
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
