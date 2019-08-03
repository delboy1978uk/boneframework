<?php

declare(strict_types=1);

namespace BoneMvc\Module\Orc\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass="\BoneMvc\Module\Orc\Repository\OrcRepository")
 */
class Orc
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
     * @var DateTime $eventTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eventTime;

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
     * @return DateTime
     */
    public function getEventTime(): ?DateTime
    {
        return $this->eventTime;
    }

    /**
     * @param DateTime|null $eventTime
     */
    public function setEventTime(?DateTime $eventTime): void
    {
        $this->eventTime = $eventTime;
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
            'eventTime' => ($eventTime = $this->getEventTime()) ? $eventTime->format($dateFormat . ' H:i') : null,
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
