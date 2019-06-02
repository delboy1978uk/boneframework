<?php

namespace BoneMvc\Module\Dragon;

use Bone\Mvc\Router\RouterConfigInterface;
use BoneMvc\Module\Dragon\Controller\DragonController;
use BoneMvc\Module\Dragon\Service\DragonService;
use Barnacle\RegistrationInterface;
use Doctrine\ORM\EntityManager;
use Barnacle\Container;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;
use Zend\Diactoros\ResponseFactory;

class DragonPackage implements RegistrationInterface, RouterConfigInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $c[DragonService::class] = $c->factory(function (Container $c) {
            $em =  $c->get(EntityManager::class);
            $service = new DragonService($em);

            return $service;
        });

        $c[DragonController::class] = $c->factory(function (Container $c) {
            $service = $c->get(DragonService::class);
            $controller = new DragonController($service);

            return $controller;
        });
    }

    /**
     * @return string
     */
    public function getEntityPath(): string
    {
        return 'src/Dragon/Entity';
    }

    /**
     * @return bool
     */
    public function hasEntityPath(): bool
    {
        return true;
    }

    public function addRoutes(Container $c, Router $router)
    {
        $router->map('GET', '/dragon', [DragonController::class, 'indexAction']);
        $router->map('GET', '/dragon/{id}', [DragonController::class, 'indexAction']);

        $factory = new ResponseFactory();
        $strategy = new JsonStrategy($factory);
        $strategy->setContainer($c);

        $router->group('/api', function (RouteGroup $route) {
            $route->map('GET', '/dragon', [DragonController::class, 'indexAction']);
            $route->map('GET', '/dragon/{id}', [DragonController::class, 'indexAction']);
        })
        ->setStrategy($strategy);

        return $router;
    }
}
