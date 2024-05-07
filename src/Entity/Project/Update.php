<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\UpdateRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: '`update`')]
#[ORM\Entity(repositoryClass: UpdateRepository::class)]
class Update
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $date;

    #[ORM\ManyToOne(targetEntity: Contact::class, inversedBy: 'updates')]
    #[ORM\JoinColumn(nullable: false)]
    private $contact;

    #[ORM\ManyToOne(targetEntity: Quest::class, inversedBy: 'updates')]
    #[ORM\JoinColumn(nullable: false)]
    private $quest;

    #[ORM\Column(type: 'json', nullable: true)]
    private $request_data = [];

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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

    public function getQuest(): ?Quest
    {
        return $this->quest;
    }

    public function setQuest(?Quest $quest): self
    {
        $this->quest = $quest;

        return $this;
    }

    public function getRequestData(): ?array
    {
        return $this->request_data;
    }

    public function setRequestData(?array $request_data): self
    {
        $this->request_data = $request_data;

        return $this;
    }
}
