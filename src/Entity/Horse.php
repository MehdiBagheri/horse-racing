<?php

namespace App\Entity;


class Horse
{
    private $speed;
    private $strength;
    private $endurance;


    public function getSpeed(): ?float
    {
        return $this->speed;
    }

    public function setSpeed(float $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getStrength(): ?float
    {
        return $this->strength;
    }

    public function setStrength(float $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getEndurance(): ?float
    {
        return $this->endurance;
    }

    public function setEndurance(float $endurance): self
    {
        $this->endurance = $endurance;

        return $this;
    }


}
