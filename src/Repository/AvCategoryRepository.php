<?php

namespace App\Repository;

use App\Entity\AvCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AvCategory>
 *
 * @method AvCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AvCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AvCategory[]    findAll()
 * @method AvCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AvCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AvCategory::class);
    }

//    /**
//     * @return AvCategory[] Returns an array of AvCategory objects
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

//    public function findOneBySomeField($value): ?AvCategory
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
