<?php

namespace App\Repository;

use App\Entity\SpaceCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SpaceCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceCategory[]    findAll()
 * @method SpaceCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpaceCategory::class);
    }

    // /**
    //  * @return SpaceCategory[] Returns an array of SpaceCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpaceCategory
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
