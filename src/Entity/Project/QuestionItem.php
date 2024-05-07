<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\QuestionItemRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: QuestionItemRepository::class)]
class QuestionItem  implements Translatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $text;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $value;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $condition_type;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $condition_value;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sequence;

    #[ORM\Column(type: 'boolean')]
    private $is_random;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'questionItems')]
    #[ORM\JoinColumn(nullable: false)]
    private $question;

   #[Gedmo\Locale]
    private $locale;

    #[ORM\Column(type: 'boolean', options: ['default' => 0], nullable: true)]
    private $is_final;

    #[ORM\Column(type: 'boolean', options: ['default' => 0], nullable: true)]
    private $is_enabled;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $is_exclusive;

    #[ORM\ManyToOne(targetEntity: Page::class, inversedBy: 'questionItems')]
    private $end_page;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

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

    public function getIsRandom(): ?bool
    {
        return $this->is_random;
    }

    public function setIsRandom(bool $is_random): self
    {
        $this->is_random = $is_random;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
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

    public function getIsEnabled(): ?bool
    {
        return $this->is_enabled;
    }

    public function setIsEnabled(bool $is_enabled): self
    {
        $this->is_enabled = $is_enabled;

        return $this;
    }

    public function getIsExclusive(): ?bool
    {
        return $this->is_exclusive;
    }

    public function setIsExclusive(?bool $is_exclusive): self
    {
        $this->is_exclusive = $is_exclusive;

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
}
