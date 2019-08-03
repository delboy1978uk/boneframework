<?php

declare(strict_types=1);

namespace BoneMvc\Module\Unicorn\Repository;

use BoneMvc\Module\Unicorn\Collection\UnicornCollection;
use BoneMvc\Module\Unicorn\Entity\Unicorn;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

class UnicornRepository extends EntityRepository
{
    /**
     * @param int $id
     * @param int|null $lockMode
     * @param int|null $lockVersion
     * @return Unicorn
     * @throws \Doctrine\ORM\ORMException
     */
    public function find($id, $lockMode = null, $lockVersion = null): Unicorn
    {
        /** @var Unicorn $unicorn */
        $unicorn =  parent::find($id, $lockMode, $lockVersion);
        if (!$unicorn) {
            throw new EntityNotFoundException('Unicorn not found.', 404);
        }

        return $unicorn;
    }

    /**
     * @param Unicorn $unicorn
     * @return $unicorn
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Unicorn $unicorn): Unicorn
    {
        if(!$unicorn->getID()) {
            $this->_em->persist($unicorn);
        }
        $this->_em->flush($unicorn);

        return $unicorn;
    }

    /**
     * @param Unicorn $unicorn
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Unicorn $unicorn): void
    {
        $this->_em->remove($unicorn);
        $this->_em->flush($unicorn);
    }

    /**
     * @return int
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalUnicornCount(): int
    {
        $qb = $this->createQueryBuilder('u');
        $qb->select('count(u.id)');
        $query = $qb->getQuery();

        return (int) $query->getSingleScalarResult();
    }
}
