<?php

namespace Fixtures;

use Bone\OAuth2\Entity\Client;
use Bone\OAuth2\Entity\Scope;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LoadClients implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $registerScope = $manager->getRepository(Scope::class)->findOneBy(['identifier' => 'register']);
        $entity = new Client();
        $entity->setName('Bone API Registration Client');
        $entity->setName('Registration Client');
        $entity->setDescription('Registers clients for devices and registers users');
        $entity->setIcon('https://boneframework.delboysplace/img/skull_and_crossbones.png');
        $entity->setGrantType('client_credentials');
        $entity->setRedirectUri('bone://oauth2/callback');
        $entity->setIdentifier(\md5($entity->getName()));
        $time = microtime();
        $name = $entity->getName();
        $secret = password_hash($name . $time  . 'bone', PASSWORD_BCRYPT);
        $base64 = base64_encode($secret);
        $entity->setSecret($base64);
        $entity->setConfidential(true);
        $entity->setScopes(new ArrayCollection([$registerScope]));
        $manager->persist($entity);
        $manager->flush();
    }
}
