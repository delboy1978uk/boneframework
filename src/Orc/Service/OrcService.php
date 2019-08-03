<?php

declare(strict_types=1);

namespace BoneMvc\Module\Orc\Service;

use BoneMvc\Module\Orc\Entity\Orc;
use BoneMvc\Module\Orc\Repository\OrcRepository;
use DateTime;
use Doctrine\ORM\EntityManager;

class OrcService
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
     * @return Orc
     */
    public function createFromArray(array $data): Orc
    {
        $orc = new Orc();

        return $this->updateFromArray($orc, $data);
    }

    /**
     * @param Orc $orc
     * @param array $data
     * @return Orc
     */
    public function updateFromArray(Orc $orc, array $data): Orc
    {
        isset($data['id']) ? $orc->setId($data['id']) : null;
        isset($data['name']) ? $orc->setName($data['name']) : null;

        if (isset($data['dob'])) {
            $dob = $data['dob'] instanceof DateTime ? $data['dob'] : DateTime::createFromFormat('d/m/Y', $data['dob']);
            $dob = $dob ?: null;
            $orc->setDob($dob);
        }

        if (isset($data['eventTime'])) {
            $eventTime = $data['eventTime'] instanceof DateTime ? $data['eventTime'] : DateTime::createFromFormat('d/m/Y H:i', $data['eventTime']);
                $eventTime = $eventTime ?: null;
            $orc->setEventTime($eventTime);
        }

        return $orc;
    }

    /**
     * @param Orc $orc
     * @return Orc
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveOrc(Orc $orc): Orc
    {
        return $this->getRepository()->save($orc);
    }

    /**
     * @param Orc $orc
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteOrc(Orc $orc): void
    {
        $this->getRepository()->delete($orc);
    }

    /**
     * @return OrcRepository
     */
    public function getRepository(): OrcRepository
    {
        /** @var OrcRepository $repository */
        $repository = $this->em->getRepository(Orc::class);

        return $repository;
    }
}
