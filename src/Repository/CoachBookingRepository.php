<?php

namespace App\Repository;

use App\Entity\CoachBooking;
use App\Entity\Client;
use App\Entity\SearchBooking;
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
    public function findBySearch(SearchBooking $searchBooking): array
    {
        $qb = $this->createQueryBuilder('o')
                    ->andWhere('o.bookingStatus = :bookingStatus')
                ->setParameter('bookingStatus', $searchBooking->getStatus());
        return $qb->getQuery()
            ->getResult();
    }
}
