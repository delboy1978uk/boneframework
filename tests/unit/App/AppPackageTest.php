<?php

namespace BoneMvcTest;

use App\Controller\IndexController;
use Barnacle\Container;
use Bone\Mvc\View\PlatesEngine;
use BoneMvc\Module\App\AppPackage;
use Codeception\TestCase\Test;
use League\Route\Router;

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
        $view = new PlatesEngine('src/App/View');
        $router = new Router();
        $container[PlatesEngine::class] = $view;
        $container[Router::class] = $router;
        $this->assertFalse($this->package->hasEntityPath());
        $this->assertEmpty($this->package->getEntityPath());
        $this->package->addToContainer($container);
        $this->assertInstanceOf(IndexController::class, $container->get(IndexController::class));
        $router = $this->package->addRoutes($container, $router);
        $this->assertInstanceOf(Router::class, $router);
    }
}