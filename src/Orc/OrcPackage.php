<?php

declare(strict_types=1);

namespace BoneMvc\Module\Orc;

use Barnacle\Container;
use Barnacle\Exception\NotFoundException;
use Barnacle\RegistrationInterface;
use BoneMvc\Module\Orc\Controller\OrcApiController;
use BoneMvc\Module\Orc\Controller\OrcController;
use BoneMvc\Module\Orc\Service\OrcService;
use Bone\Http\Middleware\HalCollection;
use Bone\Http\Middleware\HalEntity;
use Bone\Mvc\Router\RouterConfigInterface;
use Bone\Mvc\View\PlatesEngine;
use Doctrine\ORM\EntityManager;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ResponseFactory;

class OrcPackage implements RegistrationInterface, RouterConfigInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        /** @var PlatesEngine $viewEngine */
        $viewEngine = $c->get(PlatesEngine::class);
        $viewEngine->addFolder('orc', 'src/Orc/View/Orc/');

        $c[OrcService::class] = $c->factory(function (Container $c) {
            $em =  $c->get(EntityManager::class);
            return new OrcService($em);
        });

        $c[OrcController::class] = $c->factory(function (Container $c) {
            $service = $c->get(OrcService::class);
            /** @var PlatesEngine $viewEngine */
            $viewEngine = $c->get(PlatesEngine::class);

            return new OrcController($viewEngine, $service);
        });

        $c[OrcApiController::class] = $c->factory(function (Container $c) {
            $service = $c->get(OrcService::class);

            return new OrcApiController($service);
        });
    }

    /**
     * @return string
     */
    public function getEntityPath(): string
    {
        return '/src/Orc/Entity';
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
        $router->map('GET', '/orc', [OrcController::class, 'indexAction']);
        $router->map('GET', '/orc/{id:number}', [OrcController::class, 'viewAction']);
        $router->map('GET', '/orc/create', [OrcController::class, 'createAction']);
        $router->map('GET', '/orc/edit/{id:number}', [OrcController::class, 'editAction']);
        $router->map('GET', '/orc/delete/{id:number}', [OrcController::class, 'deleteAction']);

        $router->map('POST', '/orc/create', [OrcController::class, 'createAction']);
        $router->map('POST', '/orc/edit/{id:number}', [OrcController::class, 'editAction']);
        $router->map('POST', '/orc/delete/{id:number}', [OrcController::class, 'deleteAction']);

        $factory = new ResponseFactory();
        $strategy = new JsonStrategy($factory);
        $strategy->setContainer($c);

        $router->group('/api', function (RouteGroup $route) {
            $route->map('GET', '/orc', [OrcApiController::class, 'indexAction'])->prependMiddleware(new HalCollection(5));
            $route->map('GET', '/orc/{id:number}', [OrcApiController::class, 'viewAction'])->prependMiddleware(new HalEntity());
            $route->map('POST', '/orc', [OrcApiController::class, 'createAction']);
            $route->map('PUT', '/orc/{id:number}', [OrcApiController::class, 'updateAction']);
            $route->map('DELETE', '/orc/{id:number}', [OrcApiController::class, 'deleteAction']);
        })
        ->setStrategy($strategy);

        return $router;
    }
}
