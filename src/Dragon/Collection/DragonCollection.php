<?php

namespace BoneMvc\Module\Dragon\Collection;

use BoneMvc\Module\Dragon\Entity\Dragon;
use Doctrine\Common\Collections\ArrayCollection;
use LogicException;

class DragonCollection extends ArrayCollection
{
    /**
     * @param Dragon $dragon
     * @return $this
     * @throws LogicException
     */
    public function update(Dragon $dragon)
    {
        $key = $this->findKey($dragon);
        if($key) {
            $this->offsetSet($key,$dragon);
            return $this;
        }
        throw new LogicException('Dragon was not in the collection.');
    }

    /**
     * @param Dragon $dragon
     */
    public function append(Dragon $dragon)
    {
        $this->add($dragon);
    }

    /**
     * @return Dragon|null
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * @param Dragon $dragon
     * @return bool|int
     */
    public function findKey(Dragon $dragon)
    {
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $dragon->getId()) {
                return $it->key();
            }
            $it->next();
        }
        return false;
    }

    /**
     * @param int $id
     * @return Dragon|bool
     */
    public function findById(int $id)
    {
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $id) {
                return $it->current();
            }
            $it->next();
        }
        return false;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $collection = [];
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            /** @var Dragon $row */
            $row = $it->current();
            $collection[] = $row->toArray();
            $it->next();
        }

        return $collection;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return \json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }
}
