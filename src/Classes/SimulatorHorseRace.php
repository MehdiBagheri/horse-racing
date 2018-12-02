<?php
/**
 * Filename: SimulatorHorseRace.
 * User: Mithredate
 * Date: Dec, 2018
 */

namespace App\Classes;


class SimulatorHorseRace extends RaceFactory
{

    public function makeHorseRace ($numberOfParticipants, $distance)
    {
        $race = NULL;
        $race = new HorseRace(
            $numberOfParticipants,
            $distance
        );
        return $race;
    }
}