<?php
/**
 * Filename: RaceRepository.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Repository;


use App\Entity\Race;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class RaceRepository extends ServiceEntityRepository
{
    public function __construct (ManagerRegistry $registry)
    {
        parent::__construct($registry, Race::class);
    }

    public function addRace (array $raceInfo)
    {
        $race = new Race();

        $race->setDistance($raceInfo['distance']);
        $race->setParticipantNumber($raceInfo['numberOfParticipants']);

        $this->getEntityManager()->persist($race);
        $this->getEntityManager()->flush();

        return $race;
    }
}