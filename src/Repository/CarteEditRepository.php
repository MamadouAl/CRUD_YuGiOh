<?php

namespace App\Repository;

use App\Entity\CarteEdit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarteEdit>
 *
 * @method CarteEdit|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteEdit|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteEdit[]    findAll()
 * @method CarteEdit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteEditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteEdit::class);
    }

//    /**
//     * @return CarteEdit[] Returns an array of CarteEdit objects
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

//    public function findOneBySomeField($value): ?CarteEdit
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
