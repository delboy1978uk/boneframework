<?php

namespace Fixtures;

use Bone\OAuth2\Entity\OAuthUser;
use DateTime;
use Del\Factory\CountryFactory;
use Del\Person\Entity\Person;
use Del\Value\User\State;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Laminas\Crypt\Password\Bcrypt;

class LoadUsers implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $bcrypt = new Bcrypt();
        $bcrypt->setCost(14);
        $encryptedPassword = $bcrypt->create('123456');

        $person = new Person();
        $person->setFirstname('Super');
        $person->setMiddlename('');
        $person->setLastname('McUser');
        $person->setAka('superuser');
        $person->setBirthplace('Glasgow, Scotland');
        $person->setDob(new DateTime('1970-01-01 00:00:00'));
        $person->setCountry(CountryFactory::generate('GB'));

        $user = new OAuthUser();
        $user->setEmail('man@work.com');
        $user->setPassword($encryptedPassword);
        $user->setPerson($person);
        $user->setRegistrationDate(new DateTime());
        $user->setState(new State(State::STATE_ACTIVATED));

        $manager->persist($user);
        $manager->flush();
    }
}
