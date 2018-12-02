<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Race
 *
 * @ORM\Table(name="race")
 * @ORM\Entity
 */
class Race
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="participant_number", type="integer", nullable=false)
     */
    private $participantNumber;

    /**
     * @var float
     *
     * @ORM\Column(name="distance", type="float", precision=10, scale=0, nullable=false)
     */
    private $distance;

    public function getId (): ?int
    {
        return $this->id;
    }

    public function getParticipantNumber (): ?int
    {
        return $this->participantNumber;
    }

    public function setParticipantNumber (int $participantNumber): self
    {
        $this->participantNumber = $participantNumber;

        return $this;
    }

    public function getDistance (): ?float
    {
        return $this->distance;
    }

    public function setDistance (float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }


}
