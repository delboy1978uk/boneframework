<?php

declare(strict_types=1);

namespace BoneMvc\Module\Dragon\Service;

use BoneMvc\Module\Dragon\Entity\Dragon;
use BoneMvc\Module\Dragon\Repository\DragonRepository;
use DateTime;
use Doctrine\ORM\EntityManager;

class DragonService
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
     * @return Dragon
     */
    public function createFromArray(array $data): Dragon
    {
        $dragon = new Dragon();

        return $this->updateFromArray($dragon, $data);
    }

    /**
     * @param Dragon $dragon
     * @param array $data
     * @return Dragon
     */
    public function updateFromArray(Dragon $dragon, array $data): Dragon
    {
        isset($data['id']) ? $dragon->setId($data['id']) : null;
        isset($data['name']) ? $dragon->setName($data['name']) : null;

        if (isset($data['dob']) && !empty($data['dob'])) {
            $dob = $data['dob'] instanceof DateTime ? $data['dob'] : DateTime::createFromFormat('d/m/Y', $data['dob']);
            $dragon->setDob($dob);
        }

        return $dragon;
    }

    /**
     * @param Dragon $dragon
     * @return Dragon
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveDragon(Dragon $dragon): Dragon
    {
        return $this->getRepository()->save($dragon);
    }

    /**
     * @param Dragon $dragon
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteDragon(Dragon $dragon): void
    {
        $this->getRepository()->delete($dragon);
    }

    /**
     * @return DragonRepository
     */
    public function getRepository(): DragonRepository
    {
        /** @var DragonRepository $repository */
        $repository = $this->em->getRepository(Dragon::class);

        return $repository;
    }
}
