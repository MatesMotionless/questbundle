<?php

namespace Greendot\QuestBundle\Repository\Project;

use Greendot\QuestBundle\Entity\Project\Answer;
use Greendot\QuestBundle\Entity\Project\Contact;
use Greendot\QuestBundle\Entity\Project\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Answer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Answer[]    findAll()
 * @method Answer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    /*
     * @return Answer[]
     */
    public function findByQuestions(Collection $questions, Contact $contact){
        return $this->createQueryBuilder('a')
            ->where('a.question in (:questions)')
            ->andWhere('a.contact = :contact')
            ->setParameter('questions', $questions)
            ->setParameter('contact', $contact)
            ->getQuery()
            ->getResult();

    }

    /*
     * @return Answer[]
     */
    public function findByQuestion(Question $question, Contact $contact): mixed
    {
        return $this->createQueryBuilder('a')
            ->where('a.question = (:question)')
            ->andWhere('a.contact = :contact')
            ->setParameter('question', $question)
            ->setParameter('contact', $contact)
            ->getQuery()
            ->getResult();

    }

    private function getFinalQuestion(Question $question):Question
    {
        $lastQuestion = $question;
        foreach ($question->getQuestions() as $subquestion){
            if($subquestion->getSequence() > $question->getSequence()){
                $lastQuestion = $question;
            }
            $lastSub = $this->getFinalQuestion($subquestion);

            if($lastSub->getSequence() > $lastQuestion->getSequence()){
                $lastQuestion = $lastSub;
            }
        }
        return $lastQuestion;
    }

    public function deleteSkipped(Contact $contact, Question $question){


        $question = $this->getFinalQuestion($question);

        $ids = $this->createQueryBuilder('a')
            ->select('a')
            ->join(
                \Greendot\QuestBundle\Entity\Project\Question::class,
                'q',
                'WITH',
                'a.question = q.id'
            )
            ->where('a.contact = :contact')
            ->andWhere('q.sequence > :sequence')
            ->setParameter('contact', $contact)
            ->setParameter('sequence', $question->getSequence())
            //->setMaxResults(1)
            ->getQuery()
            ->getResult();
        //dd($ids);
        return $this->createQueryBuilder('a')
            ->where('a in (:ids)')
            ->setParameter('ids', $ids)
            ->delete()
            ->getQuery()
            ->execute();
    }

    // /**
    //  * @return Answer[] Returns an array of Answer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Answer
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
