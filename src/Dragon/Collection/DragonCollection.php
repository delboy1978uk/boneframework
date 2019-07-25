<?php

declare(strict_types=1);

namespace BoneMvc\Module\Dragon\Collection;

use BoneMvc\Module\Dragon\Entity\Dragon;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use LogicException;

class DragonCollection extends ArrayCollection implements JsonSerializable
{
    /**
     * @param Dragon $dragon
     * @return $this
     * @throws LogicException
     */
    public function update(Dragon $dragon): DragonCollection
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
    public function append(Dragon $dragon): void
    {
        $this->add($dragon);
    }

    /**
     * @return Dragon|null
     */
    public function current(): ?Dragon
    {
        return parent::current();
    }

    /**
     * @param Dragon $dragon
     * @return int|null
     */
    public function findKey(Dragon $dragon): ?int
    {
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $dragon->getId()) {
                return $it->key();
            }
            $it->next();
        }
        return null;
    }

    /**
     * @param int $id
     * @return Dragon|null
     */
    public function findById(int $id): ?Dragon
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
