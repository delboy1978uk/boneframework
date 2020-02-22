<?php

namespace App\Controller;

use Bone\Mvc\Controller;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class IndexController
 *
 * If you need to create a constructor, edit the package to set up automatically via dependency injection
 *
 * @package App\Controller
 */
class IndexController extends Controller
{
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
