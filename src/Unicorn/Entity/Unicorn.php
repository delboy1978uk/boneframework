<?php

declare(strict_types=1);

namespace BoneMvc\Module\Unicorn\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="\BoneMvc\Module\Unicorn\Repository\UnicornRepository")
 */
class Unicorn
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
     * @var DateTime $dob
     * @ORM\Column(type="date", nullable=true)
     */
    private $dob;

    /**
     * @var int $food
     * @ORM\Column(type="integer", length=1, nullable=true)
     */
    private $food;

    /**
     * @var bool $canFly
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $canFly;

    /**
     * @var int $drink
     * @ORM\Column(type="integer", length=1, nullable=true)
     */
    private $drink;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getDob(): ?DateTime
    {
        return $this->dob;
    }

    /**
     * @param DateTime|null $dob
     */
    public function setDob(?DateTime $dob): void
    {
        $this->dob = $dob;
    }

    /**
     * @return int
     */
    public function getFood(): ?int
    {
        return $this->food;
    }

    /**
     * @param int|null $food
     */
    public function setFood(?int $food): void
    {
        $this->food = $food;
    }

    /**
     * @return bool
     */
    public function getCanFly(): ?bool
    {
        return $this->canFly;
    }

    /**
     * @param bool|null $canFly
     */
    public function setCanFly(?bool $canFly): void
    {
        $this->canFly = $canFly;
    }

    /**
     * @return int
     */
    public function getDrink(): ?int
    {
        return $this->drink;
    }

    /**
     * @param int|null $drink
     */
    public function setDrink(?int $drink): void
    {
        $this->drink = $drink;
    }

    /**
     * @return array
     * @param string $dateFormat
     */
    public function toArray(string $dateFormat = 'd/m/Y'): array
    {
        $data = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'dob' => ($dob = $this->getDob()) ? $dob->format($dateFormat) : null,
            'food' => $this->getFood(),
            'canFly' => $this->getCanFly(),
            'drink' => $this->getDrink(),
        ];

        return $data;
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
