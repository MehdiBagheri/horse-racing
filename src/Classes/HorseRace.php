<?php
/**
 * Filename: HorseRace.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Classes;


use App\Entity\Horse;

class HorseRace
{

    const FINISHED = 2;
    const NOT_STARTED = 0;
    const RUNNING = 1;

    private $numberOfParticipants;
    private $distance;
    private $horses = [];
    private $status = 0;

    /**
     * @return mixed
     */
    public function getStatus ()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus ($status): void
    {
        $this->status = $status;
    }



    public function __construct (
        int $numberOfParticipants,
        float $distance
    )
    {
        $this->numberOfParticipants = $numberOfParticipants;
        $this->distance = $distance;
        $this->setHorses();

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumberOfParticipants ()
    {
        return $this->numberOfParticipants;
    }

    /**
     * @param mixed $numberOfParticipants
     */
    public function setNumberOfParticipants ($numberOfParticipants): void
    {
        $this->numberOfParticipants = $numberOfParticipants;
    }

    /**
     * @return mixed
     */
    public function getDistance ()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance ($distance): void
    {
        $this->distance = $distance;
    }

    private function setHorses()
    {
        for ($i = 0; $i < $this->numberOfParticipants; $i++) {
            $horseBuilder = new RaceHorseBuilder();
            $horseDirector = new RaceHorseDirector($horseBuilder);
            $horseDirector->buildHorse();
            $this->horses[$i][0] = $horseDirector->getHorse();
            $this->horses[$i][1] = ['finished'=> 0 , 'distance' => 0, 'position'=>0 , 'time'=>0];
        }
    }

    public function modifyHorses($horse){
        $this->horses = $horse;
    }

    public function getHorses(){
        return $this->horses;
    }


}