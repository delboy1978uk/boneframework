<?php

namespace BoneMvc\Module\Dragon\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="\BoneMvc\Module\Dragon\Repository\DragonRepository")
 */
class Dragon implements JsonSerializable
{
    /**
     * @var int $id
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string $name
     * @ORM\Column(type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'id' => $this->getId(),
            'name' => $this->getName(),
        ];

        return $data;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->jsonSerialize();
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return \json_encode($this->toArray());
    }


}
