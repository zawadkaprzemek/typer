<?php

namespace App\Repository;

use App\Entity\RoundStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RoundStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoundStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoundStatus[]    findAll()
 * @method RoundStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoundStatus::class);
    }

    // /**
    //  * @return RoundStatus[] Returns an array of RoundStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoundStatus
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
