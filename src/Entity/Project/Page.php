<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PageRepository::class)]
class Page implements Translatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('page_details')]
    private $id;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('page_details')]
    private $title;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups('page_details')]
    private $content;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('page_details')]
    private $slug;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups('page_details')]
    private $javascript;

    #[ORM\Column(type: 'boolean')]
    private $is_enabled;

    #[ORM\Column(type: 'boolean')]
    private $is_standalone;

    #[ORM\ManyToOne(targetEntity: Quest::class, inversedBy: 'pages')]
    #[ORM\JoinColumn(nullable: false)]
    private $quest;

    #[Gedmo\Locale]
    private $locale;

    #[ORM\Column(type: 'boolean')]
    private $is_default_final;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $transition;

    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'end_page')]
    private $questions;

    #[ORM\OneToMany(targetEntity: QuestionItem::class, mappedBy: 'end_page')]
    private $questionItems;

    #[ORM\Column(nullable: true, options: ['default'=>1])]
    private ?int $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $condition_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $condition_value = null;

    #[ORM\Column(nullable: true)]
    private ?int $sequence = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->questionItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getJavascript(): ?string
    {
        return $this->javascript;
    }

    public function setJavascript(?string $javascript): self
    {
        $this->javascript = $javascript;

        return $this;
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

    public function getIsStandalone(): ?bool
    {
        return $this->is_standalone;
    }

    public function setIsStandalone(bool $is_standalone): self
    {
        $this->is_standalone = $is_standalone;

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

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getIsDefaultFinal(): ?bool
    {
        return $this->is_default_final;
    }

    public function setIsDefaultFinal(bool $is_default_final): self
    {
        $this->is_default_final = $is_default_final;

        return $this;
    }

    public function getTransition(): ?string
    {
        return $this->transition;
    }

    public function setTransition(?string $transition): self
    {
        $this->transition = $transition;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setEndPage($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getEndPage() === $this) {
                $question->setEndPage(null);
            }
        }

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
            $questionItem->setEndPage($this);
        }

        return $this;
    }

    public function removeQuestionItem(QuestionItem $questionItem): self
    {
        if ($this->questionItems->removeElement($questionItem)) {
            // set the owning side to null (unless already changed)
            if ($questionItem->getEndPage() === $this) {
                $questionItem->setEndPage(null);
            }
        }

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

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

    public function setSequence(?int $sequence): self
    {
        $this->sequence = $sequence;

        return $this;
    }
}
