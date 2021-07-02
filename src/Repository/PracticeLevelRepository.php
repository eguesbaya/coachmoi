<?php

namespace App\Repository;

use App\Entity\PracticeLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PracticeLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method PracticeLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method PracticeLevel[]    findAll()
 * @method PracticeLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PracticeLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PracticeLevel::class);
    }

    // /**
    //  * @return PracticeLevel[] Returns an array of PracticeLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PracticeLevel
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
