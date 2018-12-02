<?php
/**
 * Filename: RaceResultRepository.
 * User: Mithredate
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

    public function addResultByRaceId($horses, $raceId)
    {
        $raceResult = new RaceResult();

        foreach ($horses as $horse){

            $raceResult->setRace($raceId);
            $raceResult->setPosition($horse[1]['position']);
            $raceResult->setTime($horse[1]['time']);
            $this->getEntityManager()->persist($raceResult);
        }
        $this->getEntityManager()->flush();

    }
}