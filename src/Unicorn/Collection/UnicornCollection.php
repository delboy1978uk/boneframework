<?php

declare(strict_types=1);

namespace BoneMvc\Module\Unicorn\Collection;

use BoneMvc\Module\Unicorn\Entity\Unicorn;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;
use LogicException;

class UnicornCollection extends ArrayCollection implements JsonSerializable
{
    /**
     * @param Unicorn $unicorn
     * @return $this
     * @throws LogicException
     */
    public function update(Unicorn $unicorn): UnicornCollection
    {
        $key = $this->findKey($unicorn);
        if($key) {
            $this->offsetSet($key,$unicorn);
            return $this;
        }
        throw new LogicException('Unicorn was not in the collection.');
    }

    /**
     * @param Unicorn $unicorn
     */
    public function append(Unicorn $unicorn): void
    {
        $this->add($unicorn);
    }

    /**
     * @return Unicorn|null
     */
    public function current(): ?Unicorn
    {
        return parent::current();
    }

    /**
     * @param Unicorn $unicorn
     * @return int|null
     */
    public function findKey(Unicorn $unicorn): ?int
    {
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $unicorn->getId()) {
                return $it->key();
            }
            $it->next();
        }
        return null;
    }

    /**
     * @param int $id
     * @return Unicorn|null
     */
    public function findById(int $id): ?Unicorn
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
            /** @var Unicorn $row */
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
