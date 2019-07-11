<?php

namespace App\Repository;

use App\Entity\TutorialTool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TutorialTool|null find($id, $lockMode = null, $lockVersion = null)
 * @method TutorialTool|null findOneBy(array $criteria, array $orderBy = null)
 * @method TutorialTool[]    findAll()
 * @method TutorialTool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TutorialTool::class);
    }

    // /**
    //  * @return Tool[] Returns an array of Tool objects
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
    public function findOneBySomeField($value): ?Tool
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
