<?php

namespace BoneMvc\Module\I18n;

use Bone\Mvc\Router\RouterConfigInterface;
use BoneMvc\Module\Dragon\Controller\DragonController;
use BoneMvc\Module\Dragon\Service\DragonService;
use Barnacle\RegistrationInterface;
use Doctrine\ORM\EntityManager;
use Barnacle\Container;
use League\Route\RouteGroup;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\ResponseFactory;

class I18nPackage implements RegistrationInterface, RouterConfigInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {

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
        $defaultLocale = $c->get('i18n')['default_locale'];
        $urlHelper = 'meh';
        $i18n= new InternationalisationMiddleware($urlHelper, $defaultLocale);
        $router->prependMiddleware($i18n);

        return $router;
    }
}
