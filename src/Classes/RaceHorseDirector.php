<?php
/**
 * Filename: RaceHorseDirector.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Classes;


class RaceHorseDirector extends HorseDirector
{
    private $builder = null;

    public function __construct (HorseBuilder $horseBuilder)
    {
        $this->builder = $horseBuilder;
    }

    public function buildHorse ()
    {

        $this->builder->setSpeed(rand(0, 10));
        $this->builder->setStrength(rand(0, 10));
        $this->builder->setEndurance(rand(0, 10));

    }

    public function getHorse ()
    {
        return $this->builder->getHorse();
    }
}