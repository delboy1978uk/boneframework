<?php

namespace BoneMvc\Module\Dragon;

use BoneMvc\Module\Dragon\Controller\DragonController;
use BoneMvc\Module\Dragon\Service\DragonService;
use Barnacle\RegistrationInterface;
use Doctrine\ORM\EntityManager;
use Barnacle\Container;

class DragonPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        $em = $c->get(EntityManager::class);
        $c[DragonService::class] = new DragonService($em);
        $c[DragonController::class] = new DragonController($c->get(DragonService::class));
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
}
