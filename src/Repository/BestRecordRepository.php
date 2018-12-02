<?php
/**
 * Filename: BestRecordRepository.
 * User: Mehdi Bagheri
 * Date: Dec, 2018
 */

namespace App\Repository;


use App\Entity\BestRecord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class BestRecordRepository extends ServiceEntityRepository
{
    public function __construct (ManagerRegistry $registry)
    {
        parent::__construct($registry, BestRecord::class);
    }


    public function setBestRecord ($bestRecordInfo)
    {
        $lastRecord = $this->getLastRecord();
        if ($lastRecord == '') {
            $this->addBestRecord($bestRecordInfo);
        } elseif ($lastRecord[0]['time'] > $bestRecordInfo['time']) {
            $this->deleteLastRecord();
            $this->addBestRecord($bestRecordInfo);
        }

    }

    public function addBestRecord ($recordInfo)
    {
        $bestRecord = new BestRecord();
        $bestRecord->setTime($recordInfo['time']);
        $bestRecord->setEndurance($recordInfo['endurance']);
        $bestRecord->setSpeed($recordInfo['speed']);
        $bestRecord->setStrength($recordInfo['strength']);

        $this->getEntityManager()->persist($bestRecord);
        $this->getEntityManager()->flush();
    }

    public function getLastRecord ()
    {
        return $this->createQueryBuilder('bestRecord')
                    ->select('bestRecord')
                    ->getQuery()
                    ->getResult(2);
    }

    public function deleteLastRecord ()
    {
        $this->createQueryBuilder('bestRecord')
             ->delete()
             ->getQuery()
             ->getResult();
    }
}