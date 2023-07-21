<?php

namespace App\Repository;

use App\Entity\Beverage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Beverage>
 *
 * @method Beverage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beverage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beverage[]    findAll()
 * @method Beverage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeverageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beverage::class);
    }

    public function findBeveragesWithMilks()
    {
        return $this->createQueryBuilder('b')
            ->join('b.liquid', 'l')
            ->where('l.name IN (:liquidNames)')
            ->setParameter('liquidNames', ['lait', 'lait végétal'])
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findBeveragesWithMatchas()
    {
        return $this->createQueryBuilder(('b'))
            ->join('b.liquid', 'l')
            ->where('l.name IN (:liquidNames)')
            ->setParameter('liquidNames', 'matcha')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findBeveragesWithSugarBrowns()
    {
        return $this->createQueryBuilder(('b'))
            ->join('b.liquid', 'l')
            ->where('l.name IN (:liquidNames)')
            ->setParameter('liquidNames', 'sugar brown')
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findBeveragesWithTeas()
    {
        return $this->createQueryBuilder(('b'))
            ->join('b.liquid', 'l')
            ->where('l.name IN (:liquidNames)')
            ->setParameter('liquidNames', ['thé vert', 'thé noir', 'jus de fruit'])
            ->orderBy('b.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Beverage[] Returns an array of Beverage objects
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

    //    public function findOneBySomeField($value): ?Beverage
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
