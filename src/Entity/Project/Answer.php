<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\AnswerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnswerRepository::class)]
class Answer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $value;

    #[ORM\Column(type: 'text', nullable: true)]
    private $text;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private $contact;

    #[ORM\ManyToOne(targetEntity: Question::class, inversedBy: 'answers')]
    #[ORM\JoinColumn(nullable: false)]
    private $question;

    #[ORM\Column(type: 'dateinterval', nullable: true)]
    private $elpased;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_filled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(?int $value): self
    {
        $this->value = $value;

        return $this;
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

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

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

    public function getElpased(): ?\DateInterval
    {
        return $this->elpased;
    }

    public function setElpased(?\DateInterval $elpased): self
    {
        $this->elpased = $elpased;

        return $this;
    }

    public function getDateFilled(): ?\DateTimeInterface
    {
        return $this->date_filled;
    }

    public function setDateFilled(?\DateTimeInterface $date_filled): self
    {
        $this->date_filled = $date_filled;

        return $this;
    }

    public function serialize()
    {
        return serialize(
            [
                $this->text,
                $this->contact,
                $this->date_filled,
                $this->elpased
            ]
        );
    }

    public function unserialize($data)
    {
        $data = unserialize($data);
        [$this->text, $this->contact, $this->date_filled, $this->elpased] = $data;
    }
}
