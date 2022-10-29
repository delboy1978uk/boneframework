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
        $basicScope = $manager->getRepository(Scope::class)->findOneBy(['identifier' => 'basic']);
        $entity = new Client();
        $entity->setName('Bone Native Client');
        $entity->setDescription('Client used in Bone React Native Project');
        $entity->setIcon('https://boneframework.delboysplace/img/skull_and_crossbones.png');
        $entity->setGrantType('auth_code');
        $entity->setRedirectUri('exp://192.168.0.204:19000/--/oauth2/callback');
        $entity->setIdentifier(\md5($entity->getName()));
        $time = \microtime();
        $name = $entity->getName();
        $secret = \password_hash($name . $time  . 'bone', PASSWORD_BCRYPT);
        $base64 = \base64_encode($secret);
        $entity->setSecret($base64);
        $entity->setConfidential(false);
        $entity->setScopes(new ArrayCollection([$basicScope]));
        $manager->persist($entity);
        $manager->flush();
    }
}
