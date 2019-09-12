<?php

declare(strict_types=1);

namespace BoneMvc\Module\Unicorn;

use Barnacle\Container;
use Barnacle\Exception\NotFoundException;
use Barnacle\RegistrationInterface;
use BoneMvc\Module\Unicorn\Controller\UnicornApiController;
use BoneMvc\Module\Unicorn\Controller\UnicornController;
use BoneMvc\Module\Unicorn\Service\UnicornService;
use Bone\Http\Middleware\HalCollection;
use Bone\Http\Middleware\HalEntity;
use Bone\Mvc\Router\RouterConfigInterface;
use Bone\Mvc\View\PlatesEngine;
use Doctrine\ORM\EntityManager;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ResponseFactory;

class UnicornPackage implements RegistrationInterface, RouterConfigInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        /** @var PlatesEngine $viewEngine */
        $viewEngine = $c->get(PlatesEngine::class);
        $viewEngine->addFolder('unicorn', 'src/Unicorn/View/Unicorn/');

        $c[UnicornService::class] = $c->factory(function (Container $c) {
            $em =  $c->get(EntityManager::class);

            return new UnicornService($em);
        });

        $c[UnicornController::class] = $c->factory(function (Container $c) {
            $service = $c->get(UnicornService::class);
            /** @var PlatesEngine $viewEngine */
            $viewEngine = $c->get(PlatesEngine::class);

            return new UnicornController($viewEngine, $service);
        });

        $c[UnicornApiController::class] = $c->factory(function (Container $c) {
            $service = $c->get(UnicornService::class);

            return new UnicornApiController($service);
        });
    }

    /**
     * @return string
     */
    public function getEntityPath(): string
    {
        return '/src/Unicorn/Entity';
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
        $router->map('GET', '/unicorn', [UnicornController::class, 'indexAction']);
        $router->map('GET', '/unicorn/{id:number}', [UnicornController::class, 'viewAction']);
        $router->map('GET', '/unicorn/create', [UnicornController::class, 'createAction']);
        $router->map('GET', '/unicorn/edit/{id:number}', [UnicornController::class, 'editAction']);
        $router->map('GET', '/unicorn/delete/{id:number}', [UnicornController::class, 'deleteAction']);

        $router->map('POST', '/unicorn/create', [UnicornController::class, 'createAction']);
        $router->map('POST', '/unicorn/edit/{id:number}', [UnicornController::class, 'editAction']);
        $router->map('POST', '/unicorn/delete/{id:number}', [UnicornController::class, 'deleteAction']);

        $factory = new ResponseFactory();
        $strategy = new JsonStrategy($factory);
        $strategy->setContainer($c);

        $router->group('/api', function (RouteGroup $route) {
            $route->map('GET', '/unicorn', [UnicornApiController::class, 'indexAction'])->prependMiddleware(new HalCollection(5));
            $route->map('GET', '/unicorn/{id:number}', [UnicornApiController::class, 'viewAction'])->prependMiddleware(new HalEntity());
            $route->map('POST', '/unicorn', [UnicornApiController::class, 'createAction']);
            $route->map('PUT', '/unicorn/{id:number}', [UnicornApiController::class, 'updateAction']);
            $route->map('DELETE', '/unicorn/{id:number}', [UnicornApiController::class, 'deleteAction']);
        })
        ->setStrategy($strategy);

        return $router;
    }
}
