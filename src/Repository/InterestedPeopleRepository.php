<?php

namespace App\Repository;

use App\Entity\InterestedPeople;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InterestedPeople|null find($id, $lockMode = null, $lockVersion = null)
 * @method InterestedPeople|null findOneBy(array $criteria, array $orderBy = null)
 * @method InterestedPeople[]    findAll()
 * @method InterestedPeople[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InterestedPeopleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InterestedPeople::class);
    }

    // /**
    //  * @return InterestedPeople[] Returns an array of InterestedPeople objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InterestedPeople
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
