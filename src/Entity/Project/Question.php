<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ORM\Cache(usage: 'NONSTRICT_READ_WRITE')]
class Question  implements Translatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'text', nullable: true)]
    private $text;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hint;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hint_left;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hint_right;

    #[ORM\Column(type: 'string', length: 10, nullable: false)]
    private $result_code;

    #[ORM\Column(type: 'boolean')]
    private $is_compulsory;

    #[ORM\Column(type: 'boolean')]
    private $is_random;

    #[ORM\ManyToOne(targetEntity: Quest::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    private $quest;


    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $condition_type;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $condition_value;

    #[ORM\Column(type: 'integer')]
    private $sequence;

    #[ORM\OneToMany(targetEntity: QuestionItem::class, mappedBy: 'question')]
    #[ORM\OrderBy(['sequence' => 'ASC'])]
    private $questionItems;

    #[ORM\OneToMany(targetEntity: Answer::class, mappedBy: 'question', orphanRemoval: true)]
    private $answers;

    #[ORM\ManyToOne(targetEntity: QuestionType::class, inversedBy: 'question')]
    #[ORM\JoinColumn(nullable: false)]
    private $questionType;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'questions')]
    private $question;

    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'question')]
    #[ORM\OrderBy(['sequence' => 'ASC'])]
    private $questions;

    #[ORM\Column(type: 'boolean')]
    private bool $is_super = false;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sequence_display;

    #[Gedmo\Locale]
    private $locale;

    #[ORM\Column(type: 'boolean', options: ['default' => 0], nullable: true)]
    private bool $is_enabled = true;

    #[ORM\Column(type: 'boolean', options: ['default' => 0], nullable: true)]
    private $is_final;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'text', nullable: true)]
    private $error_message;

    #[ORM\ManyToOne(targetEntity: Page::class, inversedBy: 'questions')]
    private $end_page;

    #[ORM\Column(type: 'boolean', options: ['default' => true])]
    private $hasButton;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $placeholder = null;

    #[ORM\Column(nullable: true)]
    private ?int $max_answers = null;

    #[ORM\Column(nullable: true)]
    private ?int $min_answers = null;



    public function __construct()
    {

        $this->questionItems = new ArrayCollection();
        $this->answers = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getHint(): ?string
    {
        return $this->hint;
    }

    public function setHint(?string $hint): self
    {
        $this->hint = $hint;

        return $this;
    }

    public function getHintLeft(): ?string
    {
        return $this->hint_left;
    }

    public function setHintLeft(?string $hint_left): self
    {
        $this->hint_left = $hint_left;

        return $this;
    }

    public function getHintRight(): ?string
    {
        return $this->hint_right;
    }

    public function setHintRight(?string $hint_right): self
    {
        $this->hint_right = $hint_right;

        return $this;
    }

    public function getResultCode(): ?string
    {
        return $this->result_code;
    }

    public function setResultCode(?string $result_code): self
    {
        $this->result_code = $result_code;

        return $this;
    }

    public function getIsCompulsory(): ?bool
    {
        return $this->is_compulsory;
    }

    public function setIsCompulsory(bool $is_compulsory): self
    {
        $this->is_compulsory = $is_compulsory;

        return $this;
    }

    public function getIsRandom(): ?bool
    {
        return $this->is_random;
    }

    public function setIsRandom(bool $is_random): self
    {
        $this->is_random = $is_random;

        return $this;
    }

    public function getQuest(): ?Quest
    {
        return $this->quest;
    }

    public function setQuest(?Quest $quest): self
    {
        $this->quest = $quest;

        return $this;
    }


    public function getConditionType(): ?string
    {
        return $this->condition_type;
    }

    public function setConditionType(?string $condition_type): self
    {
        $this->condition_type = $condition_type;

        return $this;
    }

    public function getConditionValue(): ?string
    {
        return $this->condition_value;
    }

    public function setConditionValue(?string $condition_value): self
    {
        $this->condition_value = $condition_value;

        return $this;
    }

    public function getSequence(): ?int
    {
        return $this->sequence;
    }

    public function setSequence(int $sequence): self
    {
        $this->sequence = $sequence;

        return $this;
    }

    /**
     * @return Collection|QuestionItem[]
     */
    public function getQuestionItems(): Collection
    {


        return $this->questionItems;
    }


    public function addQuestionItem(QuestionItem $questionItem): self
    {
        if (!$this->questionItems->contains($questionItem)) {
            $this->questionItems[] = $questionItem;
            $questionItem->setQuestion($this);
        }

        return $this;
    }

    public function removeQuestionItem(QuestionItem $questionItem): self
    {
        if ($this->questionItems->removeElement($questionItem)) {
            // set the owning side to null (unless already changed)
            if ($questionItem->getQuestion() === $this) {
                $questionItem->setQuestion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }

    public function getQuestionType(): ?QuestionType
    {
        return $this->questionType;
    }

    public function setQuestionType(?QuestionType $questionType): self
    {
        $this->questionType = $questionType;

        return $this;
    }

    public function getQuestion(): ?self
    {
        return $this->question;
    }

    public function setQuestion(?self $question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(self $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setQuestion($this);
        }

        return $this;
    }

    public function removeQuestion(self $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuestion() === $this) {
                $question->setQuestion(null);
            }
        }

        return $this;
    }

    public function getIsSuper(): ?bool
    {
        return $this->is_super;
    }

    public function setIsSuper(bool $is_super): self
    {
        $this->is_super = $is_super;

        return $this;
    }

    public function getSequenceDisplay(): ?int
    {
        return $this->sequence_display;
    }

    public function setSequenceDisplay(?int $sequence_display): self
    {
        $this->sequence_display = $sequence_display;

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->is_enabled;
    }

    public function setIsEnabled(bool $is_enabled): self
    {
        $this->is_enabled = $is_enabled;

        return $this;
    }

    public function getIsFinal(): ?bool
    {
        return $this->is_final;
    }

    public function setIsFinal(bool $is_final): self
    {
        $this->is_final = $is_final;

        return $this;
    }

    public function getErrorMessage(): ?string
    {
        return $this->error_message;
    }

    public function setErrorMessage(?string $error_message): self
    {
        $this->error_message = $error_message;

        return $this;
    }

    public function getEndPage(): ?Page
    {
        return $this->end_page;
    }

    public function setEndPage(?Page $end_page): self
    {
        $this->end_page = $end_page;

        return $this;
    }

    public function getHasButton(): ?bool
    {
        return $this->hasButton;
    }

    public function setHasButton(bool $hasButton): self
    {
        $this->hasButton = $hasButton;

        return $this;
    }

    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    public function setPlaceholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    public function getMaxAnswers(): ?int
    {
        return $this->max_answers;
    }

    public function setMaxAnswers(?int $max_answers): self
    {
        $this->max_answers = $max_answers;

        return $this;
    }

    public function getMinAnswers(): ?int
    {
        return $this->min_answers;
    }

    public function setMinAnswers(?int $min_answers): self
    {
        $this->min_answers = $min_answers;

        return $this;
    }
    
}
