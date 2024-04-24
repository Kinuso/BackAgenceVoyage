<?php

namespace App\Repository;

use App\Entity\AvStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvStatus>
 *
 * @method AvStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvStatus[]    findAll()
 * @method AvStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvStatus::class);
    }

//    /**
//     * @return AvStatus[] Returns an array of AvStatus objects
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

//    public function findOneBySomeField($value): ?AvStatus
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
