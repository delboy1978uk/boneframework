<?php

namespace BoneMvc\Module\Dragon;

use Barnacle\Exception\NotFoundException;
use Bone\Mvc\Router\RouterConfigInterface;
use Bone\Mvc\View\PlatesEngine;
use Bone\Mvc\View\ViewEngine;
use BoneMvc\Module\Dragon\Controller\DragonApiController;
use BoneMvc\Module\Dragon\Controller\DragonController;
use BoneMvc\Module\Dragon\Service\DragonService;
use Barnacle\RegistrationInterface;
use Doctrine\ORM\EntityManager;
use Barnacle\Container;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ResponseFactory;

class DragonPackage implements RegistrationInterface, RouterConfigInterface
{
    /**
     * @param Container $c
     * @throws NotFoundException
     */
    public function addToContainer(Container $c)
    {
        /** @var PlatesEngine $viewEngine */
        $viewEngine = $c->get(PlatesEngine::class);
        $viewEngine->addFolder('dragon', 'src/Dragon/View/Dragon/');

        $c[DragonService::class] = $c->factory(function (Container $c) {
            $em =  $c->get(EntityManager::class);
            return new DragonService($em);
        });

        $c[DragonController::class] = $c->factory(function (Container $c) {
            $service = $c->get(DragonService::class);
            /** @var PlatesEngine $viewEngine */
            $viewEngine = $c->get(PlatesEngine::class);

            return new DragonController($viewEngine, $service);
        });

        $c[DragonApiController::class] = $c->factory(function (Container $c) {
            $service = $c->get(DragonService::class);

            return new DragonApiController($service);
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

    /**
     * @param Container $c
     * @param Router $router
     * @return Router
     */
    public function addRoutes(Container $c, Router $router): Router
    {
        $router->map('GET', '/dragon', [DragonController::class, 'indexAction']);
        $router->map('GET', '/dragon/{id:number}', [DragonController::class, 'viewAction']);
        $router->map('GET', '/dragon/create', [DragonController::class, 'createAction']);
        $router->map('GET', '/dragon/edit/{id:number}', [DragonController::class, 'editAction']);
        $router->map('GET', '/dragon/delete/{id:number}', [DragonController::class, 'deleteAction']);

        $router->map('POST', '/dragon/create', [DragonController::class, 'createAction']);
        $router->map('POST', '/dragon/edit/{id:number}', [DragonController::class, 'editAction']);
        $router->map('POST', '/dragon/delete/{id:number}', [DragonController::class, 'deleteAction']);

        $factory = new ResponseFactory();
        $strategy = new JsonStrategy($factory);
        $strategy->setContainer($c);

        $router->group('/api', function (RouteGroup $route) {
            $route->map('GET', '/dragon', [DragonApiController::class, 'indexAction']);
            $route->map('GET', '/dragon/{id:number}', [DragonApiController::class, 'indexAction']);
        })
        ->setStrategy($strategy);

        return $router;
    }
}
