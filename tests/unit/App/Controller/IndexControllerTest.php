<?php

namespace BoneMvcTest\Controller;

use App\Controller\IndexController;
use Bone\Mvc\View\PlatesEngine;
use Codeception\TestCase\Test;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;

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
        $view = $this->make(PlatesEngine::class, ['render' => function() {
            return 'rendered content';
        }]);
        $this->controller = new IndexController($view);
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