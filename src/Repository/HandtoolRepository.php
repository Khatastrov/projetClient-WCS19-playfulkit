<?php

namespace App\Repository;

use App\Entity\Handtool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Handtool|null find($id, $lockMode = null, $lockVersion = null)
 * @method Handtool|null findOneBy(array $criteria, array $orderBy = null)
 * @method Handtool[]    findAll()
 * @method Handtool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HandtoolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Handtool::class);
    }

    // /**
    //  * @return Handtool[] Returns an array of Handtool objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Handtool
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
