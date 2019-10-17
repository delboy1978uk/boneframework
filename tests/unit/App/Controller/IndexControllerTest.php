<?php

namespace BoneMvcTest\Controller;

use App\Controller\IndexController;
use Barnacle\Container;
use Bone\Mvc\Controller\Init;
use Bone\Mvc\View\PlatesEngine;
use Codeception\TestCase\Test;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;
use Zend\I18n\Translator\Translator;

class IndexControllerTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var IndexController */
    protected $controller;

    /**
     * @throws \Exception
     */
    protected function _before()
    {
        $container = new Container();

        $router = new Router();
        $view = $this->getMockBuilder(PlatesEngine::class)->getMock();
        $view->expects($this->any())->method('render')->willReturn('x');
        $translator = $this->getMockBuilder(Translator::class)->getMock();

        $container[PlatesEngine::class] = $view;
        $container[Router::class] = $router;
        $container[Translator::class] = $translator;

        $view = $this->make(PlatesEngine::class, ['render' => function() {
            return 'rendered content';
        }]);
        $this->controller = new IndexController($view);
        $this->controller = Init::controller($this->controller, $container);
    }

    protected function _after()
    {
        unset($this->controller);
    }

    public function testIndexAction()
    {
        $this->assertInstanceOf(HtmlResponse::class, $this->controller->indexAction(new ServerRequest([], [], new Uri('/')), []));
    }

    public function testLearnAction()
    {
        $this->assertInstanceOf(ResponseInterface::class, $this->controller->learnAction(new ServerRequest([], [], '/'), []));
    }
}