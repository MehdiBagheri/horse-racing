<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RaceResult
 *
 * @ORM\Table(name="race_result", indexes={@ORM\Index(name="race", columns={"race"})})
 * @ORM\Entity
 */
class RaceResult
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
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var int
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    private $time;

    /**
     * @var \Race
     *
     * @ORM\ManyToOne(targetEntity="Race")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="race", referencedColumnName="id")
     * })
     */
    private $race;

    public function getId (): ?int
    {
        return $this->id;
    }

    public function getPosition (): ?int
    {
        return $this->position;
    }

    public function setPosition (int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getTime (): ?int
    {
        return $this->time;
    }

    public function setTime (int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getRace (): ?Race
    {
        return $this->race;
    }

    public function setRace (?Race $race): self
    {
        $this->race = $race;

        return $this;
    }


}
