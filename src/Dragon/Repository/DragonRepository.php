<?php

namespace BoneMvc\Module\Dragon\Repository;

use BoneMvc\Module\Dragon\Collection\DragonCollection;
use BoneMvc\Module\Dragon\Entity\Dragon;
use Doctrine\ORM\EntityRepository;

class DragonRepository extends EntityRepository
{
    /**
     * @param Dragon $dragon
     * @return $dragon
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Dragon $dragon)
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
    public function delete(Dragon $dragon)
    {
        $this->_em->remove($dragon);
        $this->_em->flush($dragon);
    }
}
