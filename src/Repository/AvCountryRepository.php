<?php

namespace App\Repository;

use App\Entity\AvCountry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvCountry>
 *
 * @method AvCountry|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvCountry|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvCountry[]    findAll()
 * @method AvCountry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvCountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvCountry::class);
    }

//    /**
//     * @return AvCountry[] Returns an array of AvCountry objects
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

//    public function findOneBySomeField($value): ?AvCountry
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
