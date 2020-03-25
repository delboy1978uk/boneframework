<?php

namespace Bone\App;

use Bone\App\Controller\IndexController;
use Bone\Controller\Init;
use Bone\Router\Router;
use Bone\Router\RouterConfigInterface;
use Barnacle\RegistrationInterface;
use Barnacle\Container;

class AppPackage implements RegistrationInterface, RouterConfigInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $c[IndexController::class] = $c->factory(function (Container $c) {
            $controller = new IndexController();

            return Init::controller($controller, $c);
        });
    }

    /**
     * @param Container $c
     * @param Router $router
     * @return Router
     */
    public function addRoutes(Container $c, Router $router): Router
    {
        $router->map('GET', '/', [IndexController::class, 'indexAction']);
        $router->map('GET', '/learn', [IndexController::class, 'learnAction']);

        return $router;
    }
}
