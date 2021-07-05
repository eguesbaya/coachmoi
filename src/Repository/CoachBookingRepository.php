<?php

namespace App\Repository;

use App\Entity\CoachBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoachBooking|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoachBooking|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoachBooking[]    findAll()
 * @method CoachBooking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoachBookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoachBooking::class);
    }

    // /**
    //  * @return CoachBooking[] Returns an array of CoachBooking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CoachBooking
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
