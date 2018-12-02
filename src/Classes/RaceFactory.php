<?php
/**
 * Filename: RaceFactory.
 * User: Mithredate
 * Date: Dec, 2018
 */

namespace App\Classes;


Abstract class RaceFactory
{
    abstract public function makeHorseRace($numberOfParticipants, $distance);
}