<?php

namespace BoneMvc\Module\Dragon;

use BoneMvc\Module\Dragon\Service\DragonService;
use Del\Common\Container\RegistrationInterface;
use Doctrine\ORM\EntityManager;
use Pimple\Container;

class DragonPackage implements RegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        /** @var EntityManager $em */
        $em = $c['doctrine.entity_manager'];
        $c['service.Dragon'] = new DragonService($em);
    }

    /**
     * @return string
     */
    public function getEntityPath()
    {
        return 'build/5cef402a1337d/src/Dragon/Entity';
    }

    /**
     * @return bool
     */
    public function hasEntityPath()
    {
        return true;
    }
}
