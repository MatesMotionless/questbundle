<?php

namespace Greendot\QuestBundle\Repository\Project;

use Greendot\QuestBundle\Entity\Project\QuestLanguage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestLanguage|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestLanguage|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestLanguage[]    findAll()
 * @method QuestLanguage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestLanguageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestLanguage::class);
    }

    // /**
    //  * @return QuestLanguage[] Returns an array of QuestLanguage objects
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
    public function findOneBySomeField($value): ?QuestLanguage
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
