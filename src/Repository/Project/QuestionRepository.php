<?php

namespace Greendot\QuestBundle\Repository\Project;

use Greendot\QuestBundle\Entity\Project\Contact;
use Greendot\QuestBundle\Entity\Project\Quest;
use Greendot\QuestBundle\Entity\Project\Question;
use App\Service\ConditionQuestion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private readonly ConditionQuestion $conditionQuestion, private readonly AnswerRepository $answerRepository)
    {
        parent::__construct($registry, Question::class);
    }

    public function findNextWithHistory(Question $question, Collection $answers, Contact $contact) :Question|bool
    {

        $next = $this->findNext($question);


        if(!$next){
            return false;
        }elseif($next->getConditionType() === null){
            return $next;
        }


        if($this->conditionQuestion->checkCondition($next, $answers, $contact)){
            return $next;
        }else{

            $projectEntityManager = $this->answerRepository->getEntityManager();

            $questions = $next->getQuestions();

            $questions->add($next);


            $answers_delete = $this->answerRepository->findByQuestions($questions, $contact);

            foreach ($answers_delete as $answer) {
                $projectEntityManager->remove($answer);

            }


            $projectEntityManager->flush();

            return $this->findNextWithHistory($next, $answers, $contact);
        }
    }

    public function findPrevWithHistory(Question $question, Collection $answers, Contact $contact) :Question|bool
    {
        $next = $this->findPrevious($question);

        if (!$next){
            return false;
        }elseif($next->getConditionType() === null){
            return $next;
        }

        if($this->conditionQuestion->checkCondition($next, $answers, $contact)){
            return $next;
        }else{
            return $this->findPrevWithHistory($next, $answers, $contact);
        }
    }


    /**
     * @return Question[]|Collection
     */
    public function findSubWithHistory(Question $question, Collection $answers, Contact $contact): array|\Doctrine\Common\Collections\Collection{
        $subquestions = $question->getQuestions();

        if($subquestions->count() == 0){
            return $subquestions;
        }

        $subquestions_random_filtered = new ArrayCollection();
        $subquestions_fixed_filtered = new ArrayCollection();

        $subquestions_random_filtered_array = [];

        foreach ($subquestions as $subquestion) {
            if($subquestion->getConditionType() === null || $subquestion->getConditionType() === "" || $subquestion->getConditionType() === "sub"){
                if($subquestion->getIsRandom()){
                    $subquestions_random_filtered->add($subquestion);
                }else {
                    $subquestions_fixed_filtered->add($subquestion);
                }
            }elseif($this->conditionQuestion->checkCondition($subquestion, $answers, $contact)){
                if($subquestion->getIsRandom()){
                    $subquestions_random_filtered->add($subquestion);
                }else {
                    $subquestions_fixed_filtered->add($subquestion);
                }
            }
        }

        $subquestions_random_filtered_array = $subquestions_random_filtered->toArray();
        shuffle($subquestions_random_filtered_array);


        $subquestions_filtered = new ArrayCollection(array_merge($subquestions_random_filtered_array, $subquestions_fixed_filtered->toArray()));



        return $subquestions_filtered;


    }

    public function findNext(Question $question){

        return $this->createQueryBuilder('q')->andWhere('q.quest = :quest')->andWhere('q.sequence > :sequence')
            ->andWhere('q.question is null')
            ->setParameter('quest', $question->getQuest())
            ->setParameter('sequence', $question->getSequence())
            ->orderBy('q.sequence', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                \Gedmo\Translatable\Query\TreeWalker\TranslationWalker::class)
            ->setHint(
                \Gedmo\Translatable\TranslatableListener::HINT_FALLBACK,
                1
            )
            ->getOneOrNullResult();
    }


    public function findPrevious(Question $question){
        return $this->createQueryBuilder('q')
            ->andWhere('q.quest = :quest')
            ->andWhere('q.sequence < :sequence')
            ->andWhere('q.question is null')
            ->setParameter('quest', $question->getQuest())
            ->setParameter('sequence', $question->getSequence())
            ->orderBy('q.sequence', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                \Gedmo\Translatable\Query\TreeWalker\TranslationWalker::class)
            ->setHint(
                \Gedmo\Translatable\TranslatableListener::HINT_FALLBACK,
                1
            )
            ->getOneOrNullResult();

    }

    public function getPosition(Question $question){
        return $this->createQueryBuilder('q')->select('COUNT(q)')
            ->andWhere('q.quest = :quest')
            ->andWhere('q.sequence < :sequence')
            ->andWhere('q.question is null')
            ->setParameter('quest', $question->getQuest())
            ->setParameter('sequence', $question->getSequence())
            ->orderBy('q.sequence', 'DESC')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findSingleById($id){
        return $this->createQueryBuilder('q')
            ->where("q.id = $id")
            ->getQuery()
            ->setHint(\Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
                \Gedmo\Translatable\Query\TreeWalker\TranslationWalker::class)
            ->setHint(
                \Gedmo\Translatable\TranslatableListener::HINT_FALLBACK,
                1
            )
            ->getSingleResult(Query::HYDRATE_OBJECT);
    }


    public function findLastAnswered(Contact $contact){


        return $this->createQueryBuilder('q')
            ->select('q')
            ->join(
                \Greendot\QuestBundle\Entity\Project\Answer::class,
                'a',
                'WITH',
                'a.question = q.id'
            )
            ->where('a.contact = :contact')
            ->andWhere('q.is_enabled = 1')
            ->andWhere('q.question is null')
            ->orderBy('q.sequence', 'DESC')
            ->setParameter('contact', $contact)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

    }


    // /**
    //  * @return Question[] Returns an array of Question objects
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
    public function findOneBySomeField($value): ?Question
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
