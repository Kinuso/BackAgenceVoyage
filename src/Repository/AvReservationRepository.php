<?php

namespace App\Repository;

use App\Entity\AvReservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvReservation>
 *
 * @method AvReservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvReservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvReservation[]    findAll()
 * @method AvReservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvReservation::class);
    }

//    /**
//     * @return AvReservation[] Returns an array of AvReservation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AvReservation
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
