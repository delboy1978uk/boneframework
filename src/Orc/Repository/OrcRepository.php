<?php

declare(strict_types=1);

namespace BoneMvc\Module\Orc\Repository;

use BoneMvc\Module\Orc\Collection\OrcCollection;
use BoneMvc\Module\Orc\Entity\Orc;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

class OrcRepository extends EntityRepository
{
    /**
     * @param int $id
     * @param int|null $lockMode
     * @param int|null $lockVersion
     * @return Orc
     * @throws \Doctrine\ORM\ORMException
     */
    public function find($id, $lockMode = null, $lockVersion = null): Orc
    {
        /** @var Orc $orc */
        $orc =  parent::find($id, $lockMode, $lockVersion);
        if (!$orc) {
            throw new EntityNotFoundException('Orc not found.', 404);
        }

        return $orc;
    }

    /**
     * @param Orc $orc
     * @return $orc
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Orc $orc): Orc
    {
        if(!$orc->getID()) {
            $this->_em->persist($orc);
        }
        $this->_em->flush($orc);

        return $orc;
    }

    /**
     * @param Orc $orc
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Orc $orc): void
    {
        $this->_em->remove($orc);
        $this->_em->flush($orc);
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalOrcCount(): int
    {
        $qb = $this->createQueryBuilder('o');
        $qb->select('count(o.id)');
        $query = $qb->getQuery();

        return (int) $query->getSingleScalarResult();
    }
}
