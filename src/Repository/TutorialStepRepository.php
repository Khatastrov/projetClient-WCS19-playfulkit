<?php

namespace App\Repository;

use App\Entity\TutorialStep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TutorialStep|null find($id, $lockMode = null, $lockVersion = null)
 * @method TutorialStep|null findOneBy(array $criteria, array $orderBy = null)
 * @method TutorialStep[]    findAll()
 * @method TutorialStep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TutorialStepRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TutorialStep::class);
    }

    // /**
    //  * @return TutorialStep[] Returns an array of TutorialStep objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TutorialStep
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
