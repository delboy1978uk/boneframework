<?php

namespace Fixtures;

use Bone\OAuth2\Entity\Scope;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LoadScopes implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $entity = new Scope();
        $entity->setIdentifier('register');
        $entity->setDescription('register a client via the api');
        $manager->persist($entity);
        $manager->flush();

        $entity = new Scope();
        $entity->setIdentifier('basic');
        $entity->setDescription('access api data');
        $manager->persist($entity);
        $manager->flush();
    }
}
