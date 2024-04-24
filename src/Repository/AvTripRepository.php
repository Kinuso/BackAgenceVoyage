<?php

namespace App\Repository;

use App\Entity\AvTrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvTrip>
 *
 * @method AvTrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvTrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvTrip[]    findAll()
 * @method AvTrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvTripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvTrip::class);
    }

//    /**
//     * @return AvTrip[] Returns an array of AvTrip objects
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

//    public function findOneBySomeField($value): ?AvTrip
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
