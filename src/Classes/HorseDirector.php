<?php
/**
 * Filename: HorseDirector.
 * User: Mithredate
 * Date: Dec, 2018
 */

namespace App\Classes;


Abstract class HorseDirector
{
    abstract function __construct (HorseBuilder $horseBuilder);

    abstract function buildHorse();

    abstract function getHorse();
}