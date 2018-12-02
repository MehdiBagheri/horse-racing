<?php
/**
 * Filename: RaceFactory.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Classes;


Abstract class RaceFactory
{
    abstract public function makeHorseRace ($numberOfParticipants, $distance);
}