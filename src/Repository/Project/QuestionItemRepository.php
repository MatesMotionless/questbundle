<?php

namespace Greendot\QuestBundle\Repository\Project;

use Greendot\QuestBundle\Entity\Project\Question;
use Greendot\QuestBundle\Entity\Project\QuestionItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuestionItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionItem[]    findAll()
 * @method QuestionItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionItem::class);
    }

    public function findQuestionRandomised(Question $question){

        return $this->createQueryBuilder('q')
            ->andWhere('q.question = :question')
            ->setParameter('question', $question)
            ->orderBy('q.id', 'ASC')
            ->getQuery()
            ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                \Gedmo\Translatable\Query\TreeWalker\TranslationWalker::class)
            ->setHint(
                \Gedmo\Translatable\TranslatableListener::HINT_FALLBACK,
                1
            )
            ->getResult();
    }


    // /**
    //  * @return QuestionItem[] Returns an array of QuestionItem objects
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
    public function findOneBySomeField($value): ?QuestionItem
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
