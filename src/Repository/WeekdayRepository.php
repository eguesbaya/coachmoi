<?php

namespace App\Repository;

use App\Entity\Weekday;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Weekday|null find($id, $lockMode = null, $lockVersion = null)
 * @method Weekday|null findOneBy(array $criteria, array $orderBy = null)
 * @method Weekday[]    findAll()
 * @method Weekday[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeekdayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Weekday::class);
    }

    // /**
    //  * @return Weekday[] Returns an array of Weekday objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Weekday
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
