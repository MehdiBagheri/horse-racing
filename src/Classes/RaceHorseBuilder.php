<?php
/**
 * Filename: RaceHorseBuilder.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Classes;


use App\Entity\Horse;

class RaceHorseBuilder extends HorseBuilder
{
    private $horse = null;

    public function __construct ()
    {
        $this->horse = new Horse();
    }

    public function setSpeed (float $speed)
    {
        $this->horse->setSpeed($speed);
    }

    public function setStrength (float $strength)
    {
        $this->horse->setStrength($strength);
    }

    public function setEndurance (float $endurance)
    {
        $this->horse->setEndurance($endurance);
    }

    public function getHorse ()
    {
        return $this->horse;
    }
}