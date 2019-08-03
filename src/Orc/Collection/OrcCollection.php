<?php

declare(strict_types=1);

namespace BoneMvc\Module\Orc\Collection;

use BoneMvc\Module\Orc\Entity\Orc;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use LogicException;

class OrcCollection extends ArrayCollection implements JsonSerializable
{
    /**
     * @param Orc $orc
     * @return $this
     * @throws LogicException
     */
    public function update(Orc $orc): OrcCollection
    {
        $key = $this->findKey($orc);
        if($key) {
            $this->offsetSet($key,$orc);
            return $this;
        }
        throw new LogicException('Orc was not in the collection.');
    }

    /**
     * @param Orc $orc
     */
    public function append(Orc $orc): void
    {
        $this->add($orc);
    }

    /**
     * @return Orc|null
     */
    public function current(): ?Orc
    {
        return parent::current();
    }

    /**
     * @param Orc $orc
     * @return int|null
     */
    public function findKey(Orc $orc): ?int
    {
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $orc->getId()) {
                return $it->key();
            }
            $it->next();
        }
        return null;
    }

    /**
     * @param int $id
     * @return Orc|null
     */
    public function findById(int $id): ?Orc
    {
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $id) {
                return $it->current();
            }
            $it->next();
        }
        return null;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $collection = [];
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            /** @var Orc $row */
            $row = $it->current();
            $collection[] = $row->toArray();
            $it->next();
        }

        return $collection;
    }

    /**
     * @return string
     */
    public function jsonSerialize(): string
    {
        return \json_encode($this->toArray());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->jsonSerialize();
    }
}
