<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BestRecord
 *
 * @ORM\Table(name="best_record")
 * @ORM\Entity(repositoryClass="App\Repository\BestRecordRepository")
 */
class BestRecord
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
     * @ORM\Column(name="speed", type="integer", nullable=false)
     */
    private $speed;

    /**
     * @var int
     *
     * @ORM\Column(name="strength", type="integer", nullable=false)
     */
    private $strength;

    /**
     * @var int
     *
     * @ORM\Column(name="endurance", type="integer", nullable=false)
     */
    private $endurance;

    /**
     * @var int
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    private $time;

    public function getId (): ?int
    {
        return $this->id;
    }

    public function getSpeed (): ?int
    {
        return $this->speed;
    }

    public function setSpeed (int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getStrength (): ?int
    {
        return $this->strength;
    }

    public function setStrength (int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getEndurance (): ?int
    {
        return $this->endurance;
    }

    public function setEndurance (int $endurance): self
    {
        $this->endurance = $endurance;

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


}
