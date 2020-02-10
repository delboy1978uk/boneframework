<?php

namespace BoneMvc\Module\App;

use App\Controller\IndexController;
use Bone\Mvc\Controller\Init;
use Bone\Mvc\Router\RouterConfigInterface;
use Barnacle\RegistrationInterface;
use Barnacle\Container;
use Bone\OAuth2\Http\Middleware\ResourceServerMiddleware;
use League\Route\Router;

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
        $router->map('GET', '/', [IndexController::class, 'indexAction']);
        $router->map('GET', '/learn', [IndexController::class, 'learnAction']);

        return $router;
    }
}
