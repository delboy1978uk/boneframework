<?php

declare(strict_types=1);

namespace BoneMvc\Module\Unicorn\Service;

use BoneMvc\Module\Unicorn\Entity\Unicorn;
use BoneMvc\Module\Unicorn\Repository\UnicornRepository;
use DateTime;
use Doctrine\ORM\EntityManager;

class UnicornService
{
    /** @var EntityManager $em */
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $data
     * @return Unicorn
     */
    public function createFromArray(array $data): Unicorn
    {
        $unicorn = new Unicorn();

        return $this->updateFromArray($unicorn, $data);
    }

    /**
     * @param Unicorn $unicorn
     * @param array $data
     * @return Unicorn
     */
    public function updateFromArray(Unicorn $unicorn, array $data): Unicorn
    {
        isset($data['id']) ? $unicorn->setId($data['id']) : null;
        isset($data['name']) ? $unicorn->setName($data['name']) : $unicorn->setName('');

        $unicorn->setDob(null);
        if (isset($data['dob'])) {
            $dob = $data['dob'] instanceof DateTime ? $data['dob'] : DateTime::createFromFormat('d/m/Y', $data['dob']);
            $dob = $dob ?: null;
            $unicorn->setDob($dob);
        }
        isset($data['food']) ? $unicorn->setFood((int) $data['food']) : null;
        $unicorn->setCanFly(isset($data['canFly']));
        isset($data['drink']) ? $unicorn->setDrink((int) $data['drink']) : null;

        return $unicorn;
    }

    /**
     * @param Unicorn $unicorn
     * @return Unicorn
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveUnicorn(Unicorn $unicorn): Unicorn
    {
        return $this->getRepository()->save($unicorn);
    }

    /**
     * @param Unicorn $unicorn
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteUnicorn(Unicorn $unicorn): void
    {
        $this->getRepository()->delete($unicorn);
    }

    /**
     * @return UnicornRepository
     */
    public function getRepository(): UnicornRepository
    {
        /** @var UnicornRepository $repository */
        $repository = $this->em->getRepository(Unicorn::class);

        return $repository;
    }
}
