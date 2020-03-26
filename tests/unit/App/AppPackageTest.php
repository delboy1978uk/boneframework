<?php

namespace BoneMvcTest;

use Bone\App\Controller\IndexController;
use Barnacle\Container;
use Bone\View\ViewEngine;
use Bone\Server\SiteConfig;
use Bone\App\AppPackage;
use Codeception\TestCase\Test;
use Bone\Router\Router;
use Laminas\I18n\Translator\Translator;

class AppPackageTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var AppPackage $package */
    protected $package;

    /**
     * @throws \Exception
     */
    protected function _before()
    {
        $this->package = new AppPackage();
    }

    protected function _after()
    {
        unset($this->package);
    }

    public function testAddToContainer()
    {
        $container = new Container();

        $view = new ViewEngine('src/App/View');
        $router = new Router();
        $translator = $this->getMockBuilder(Translator::class)->getMock();
        $site = $this->getMockBuilder(SiteConfig::class)->disableOriginalConstructor()->getMock();
        $container[SiteConfig::class] = $site;

        $container[ViewEngine::class] = $view;
        $container[Router::class] = $router;
        $container[Translator::class] = $translator;

        $this->package->addToContainer($container);

        $this->assertInstanceOf(IndexController::class, $container->get(IndexController::class));

        $router = $this->package->addRoutes($container, $router);

        $this->assertInstanceOf(Router::class, $router);
    }
}