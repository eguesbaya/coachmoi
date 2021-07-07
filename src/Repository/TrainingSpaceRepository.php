<?php

namespace App\Repository;

use App\Entity\TrainingSpace;
use App\Entity\Activity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrainingSpace|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingSpace|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingSpace[]    findAll()
 * @method TrainingSpace[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingSpaceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingSpace::class);
    }

    public function myFindByActivity(Activity $activity): array
    {
        return $this->createQueryBuilder('t')
           ->leftJoin('t.activity', 'a')
           ->andWhere('a.id = :id')
           ->setParameter('id', $activity)
           ->getQuery()
           ->getResult()
        ;
    }
    // /**
    //  * @return TrainingSpace[] Returns an array of TrainingSpace objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrainingSpace
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
