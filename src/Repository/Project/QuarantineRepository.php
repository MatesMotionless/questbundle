<?php

namespace Greendot\QuestBundle\Repository\Project;

use Greendot\QuestBundle\Entity\Project\Quarantine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Quarantine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quarantine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quarantine[]    findAll()
 * @method Quarantine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuarantineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Quarantine::class);
    }

    // /**
    //  * @return Quarantine[] Returns an array of Quarantine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Quarantine
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
