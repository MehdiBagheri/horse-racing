<?php
/**
 * Filename: HorseRaceResult.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Classes;


class HorseRaceResult
{

    public function getResult ($race)
    {
        $positions = [];
        $result = [];
        $horses = $race->getHorses();
        for ($j = 0; $j < 10; $j++) {
            for ($i = 0; $i < count($horses); $i++) {
                $horses[$i][1]['distance'] += $this->getDistance($horses[$i]);

                if ($horses[$i][1]['distance'] >= 1500) {
                    $horses[$i][1]['finished'] = true;
                    $horses[$i][1]['distance'] = 1500;
                    $positions [$i] = $horses[$i][1]['distance'] + 1500 - $horses[$i][1]['time'];
                } else {
                    $horses[$i][1]['time'] += 1;
                    $positions [$i] = $horses[$i][1]['distance'];
                }
                $result [$i]['distance'] = $horses[$i][1]['distance'];
                $result [$i]['time'] = $horses[$i][1]['time'];
            }
            $this->getPosition($positions, $horses);
        }
        $race->modifyHorses($horses);
        if(min($positions) >= 1500)
        {
            $race->setStatus(HorseRace::FINISHED);
        }else{
            $race->setStatus(HorseRace::RUNNING);
        }
        return $race;
    }

    private function getDistance($horse){

        if($horse[1]['distance'] <1500) {
            if ($horse[0]->getEndurance() * 100 < $horse[1]['distance']) {
                $reducedAmountOfSpeed = ((($horse[0]->getStrength() * 8) * 5 / (100)));

                return ($horse[0]->getSpeed() + (5 - $reducedAmountOfSpeed));
            } else {
                return ($horse[0]->getSpeed() + 5);
            }
        }
    }

    private function getPosition(array $positions, array &$horses)
    {
        rsort($positions);

        for($k = 0; $k < count($horses); $k++){
            if($horses[$k][1]['finished']==false){
                $horses[$k][1]['position'] = array_search($horses[$k][1]['distance'], $positions) +1;
            }else{
                $horses[$k][1]['position'] = array_search(
                        $horses[$k][1]['distance']+1500-$horses[$k][1]['time'],
                        $positions) +1;
            }
        }
    }


}