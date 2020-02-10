<?php

namespace BoneMvcTest\Controller;

use App\Controller\IndexController;
use Barnacle\Container;
use Bone\Mvc\Controller\Init;
use Bone\Mvc\View\PlatesEngine;
use Bone\Server\SiteConfig;
use Codeception\TestCase\Test;
use League\Route\Router;
use Psr\Http\Message\ResponseInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Uri;
use Laminas\I18n\Translator\Translator;

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
        $site = $this->getMockBuilder(SiteConfig::class)->disableOriginalConstructor()->getMock();

        $container[PlatesEngine::class] = $view;
        $container[Router::class] = $router;
        $container[SiteConfig::class] = $site;
        $container[Translator::class] = $translator;

        $view = $this->make(PlatesEngine::class, ['render' => function() {
            return 'rendered content';
        }]);
        $container[PlatesEngine::class] = $view;
        $this->controller = new IndexController();
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