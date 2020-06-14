<?php

namespace App\Repository;

use App\Entity\OnlineClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OnlineClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method OnlineClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method OnlineClass[]    findAll()
 * @method OnlineClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OnlineClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OnlineClass::class);
    }

    // /**
    //  * @return OnlineClass[] Returns an array of OnlineClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OnlineClass
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findExistingClasses()
    {
        $qb = $this->createQueryBuilder('o');

        $qb->select('o.class')
        ->orderBy('o.class','ASC');

        return array_values(array_unique(array_column($qb->getQuery()->getResult(),'class')));

    }
}
