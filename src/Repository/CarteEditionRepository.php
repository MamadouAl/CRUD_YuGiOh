<?php

namespace App\Repository;

use App\Entity\CarteEdition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarteEdition>
 *
 * @method CarteEdition|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteEdition|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteEdition[]    findAll()
 * @method CarteEdition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteEditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteEdition::class);
    }

    public function findByCarteId($carteId) : array
    {
        return $this->createQueryBuilder('ce')
            ->andWhere('ce.carte = :carteId')
            ->setParameter('carteId', $carteId)
            ->getQuery()
            ->getResult();
    }



//    /**
//     * @return CarteEdition[] Returns an array of CarteEdition objects
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

//    public function findOneBySomeField($value): ?CarteEdition
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
