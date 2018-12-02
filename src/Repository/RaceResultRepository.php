<?php
/**
 * Filename: RaceResultRepository.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Repository;


use App\Entity\RaceResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class RaceResultRepository extends ServiceEntityRepository
{

    public function __construct (ManagerRegistry $registry)
    {
        parent::__construct($registry, RaceResult::class);
    }

    public function addResultByRaceId ($horses, $raceId)
    {
        $bestRecord = [];
        for ($i = 0; $i < count($horses); $i++) {
            if ($horses[$i][1]['position'] == 1) {
                $bestRecord = [
                    'time'      => $horses[$i][1]['time'],
                    'speed'     => $horses[$i][0]->getSpeed(),
                    'strength'  => $horses[$i][0]->getStrength(),
                    'endurance' => $horses[$i][0]->getEndurance(),
                ];
            }

            $raceResult = new RaceResult();
            $raceResult->setRace($raceId);
            $raceResult->setPosition($horses[$i][1]['position']);
            $raceResult->setTime($horses[$i][1]['time']);
            $this->getEntityManager()->persist($raceResult);

        }
        $this->getEntityManager()->flush();

        return $bestRecord;

    }
}