<?php

declare(strict_types=1);

namespace BoneMvc\Module\Test;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use BoneMvc\Mail\Service\MailService;
use BoneMvc\Module\Test\Controller\TestApiController;
use BoneMvc\Module\Test\Controller\TestController;
use Bone\Mvc\Router\RouterConfigInterface;
use Bone\Mvc\View\PlatesEngine;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ResponseFactory;

class TestPackage implements RegistrationInterface, RouterConfigInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        /** @var PlatesEngine $viewEngine */
        $viewEngine = $c->get(PlatesEngine::class);
        $viewEngine->addFolder('test', __DIR__ . '/View/Test/');
        $viewEngine->addFolder('testemails', __DIR__ . '/View/emails/');

        $c[TestController::class] = $c->factory(function (Container $c) {
            /** @var PlatesEngine $viewEngine */
            $viewEngine = $c->get(PlatesEngine::class);

            /** @var MailService $mailService */
            $mailService = $c->get(MailService::class);

            return new TestController($viewEngine, $mailService);
        });

        $c[TestApiController::class] = $c->factory(function (Container $c) {
            return new TestApiController();
        });
    }

    /**
     * @return string
     */
    public function getEntityPath(): string
    {
        return '';
    }

    /**
     * @return bool
     */
    public function hasEntityPath(): bool
    {
        return false;
    }

    /**
     * @param Container $c
     * @param Router $router
     * @return Router
     */
    public function addRoutes(Container $c, Router $router): Router
    {
        $router->map('GET', '/test', [TestController::class, 'indexAction']);

        $factory = new ResponseFactory();
        $strategy = new JsonStrategy($factory);
        $strategy->setContainer($c);

        $router->group('/api', function (RouteGroup $route) {
            $route->map('GET', '/test', [TestApiController::class, 'indexAction']);
        })
        ->setStrategy($strategy);

        return $router;
    }
}
