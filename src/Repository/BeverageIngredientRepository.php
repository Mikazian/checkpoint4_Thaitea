<?php

namespace App\Repository;

use App\Entity\BeverageIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BeverageIngredient>
 *
 * @method BeverageIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeverageIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeverageIngredient[]    findAll()
 * @method BeverageIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeverageIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BeverageIngredient::class);
    }

//    /**
//     * @return BeverageIngredient[] Returns an array of BeverageIngredient objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BeverageIngredient
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
