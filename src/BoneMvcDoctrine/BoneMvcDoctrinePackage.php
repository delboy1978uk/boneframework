<?php

namespace BoneMvc\Module\BoneMvcDoctrine;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

class BoneMvcDoctrinePackage implements RegistrationInterface
{
    /**
     * @param Container $c
     * @throws \Doctrine\ORM\ORMException
     */
    public function addToContainer(Container $c)
    {
        /** @var EntityManager $em */
        $credentials = $c->get('db');
        $entityPaths = $c->get('entity_paths');
        $isDevMode = false;


        $config = Setup::createAnnotationMetadataConfiguration($entityPaths, $isDevMode, null, null, false);
        $config->setProxyDir($c->get('proxy_dir'));

        $entityManager = EntityManager::create($credentials, $config);

        // The Doctrine Entity Manager
        $c[EntityManager::class] = $entityManager;
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
}
