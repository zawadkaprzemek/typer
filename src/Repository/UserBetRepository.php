<?php

namespace App\Repository;

use App\Entity\UserBet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UserBet|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserBet|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserBet[]    findAll()
 * @method UserBet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserBetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserBet::class);
    }

    // /**
    //  * @return UserBet[] Returns an array of UserBet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserBet
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
