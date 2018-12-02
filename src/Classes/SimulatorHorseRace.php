<?php
/**
 * Filename: SimulatorHorseRace.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Classes;


class SimulatorHorseRace extends RaceFactory
{

    public function makeHorseRace ($numberOfParticipants, $distance)
    {
        $race = null;
        $race = new HorseRace(
            $numberOfParticipants,
            $distance
        );

        return $race;
    }
}