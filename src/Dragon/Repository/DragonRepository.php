<?php

namespace BoneMvc\Module\Dragon\Repository;

use BoneMvc\Module\Dragon\Collection\DragonCollection;
use BoneMvc\Module\Dragon\Entity\Dragon;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

class DragonRepository extends EntityRepository
{
    /**
     * @param mixed $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return Dragon
     * @throws EntityNotFoundException
     */
    public function find($id, $lockMode = null, $lockVersion = null): Dragon
    {
        /** @var Dragon $dragon */
        $dragon =  parent::find($id, $lockMode, $lockVersion);

        if (!$dragon) {
            throw new EntityNotFoundException('Dragon not found.', 404);
        }

        return $dragon;
    }

    /**
     * @param Dragon $dragon
     * @return $dragon
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Dragon $dragon): Dragon
    {
        if(!$dragon->getID()) {
            $this->_em->persist($dragon);
        }
        $this->_em->flush($dragon);

        return $dragon;
    }

    /**
     * @param Dragon $dragon
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function delete(Dragon $dragon): void
    {
        $this->_em->remove($dragon);
        $this->_em->flush($dragon);
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalDragonCount()
    {
        $qb = $this->createQueryBuilder('d');
        $qb->select('count(d.id)');
        $query = $qb->getQuery();

        return (int) $query->getSingleScalarResult();
    }
}
