<?php

namespace App\Repository;

use App\Entity\CartePossedee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CartePossedee>
 *
 * @method CartePossedee|null find($id, $lockMode = null, $lockVersion = null)
 * @method CartePossedee|null findOneBy(array $criteria, array $orderBy = null)
 * @method CartePossedee[]    findAll()
 * @method CartePossedee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CartePossedeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartePossedee::class);
    }

//    /**
//     * @return CartePossedee[] Returns an array of CartePossedee objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CartePossedee
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
