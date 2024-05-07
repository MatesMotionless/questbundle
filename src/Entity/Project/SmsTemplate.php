<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\SmsTemplateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: SmsTemplateRepository::class)]
class SmsTemplate implements Translatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'smsTemplates')]
    private ?Quest $Quest = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Gedmo\Translatable]
    private ?string $invitaitionMessage = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Gedmo\Translatable]
    private ?string $reminderMessage = null;

    #[Gedmo\Locale]
    private $locale;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuest(): ?Quest
    {
        return $this->Quest;
    }

    public function setQuest(?Quest $Quest): self
    {
        $this->Quest = $Quest;

        return $this;
    }

    public function getInvitaitionMessage(): ?string
    {
        return $this->invitaitionMessage;
    }

    public function setInvitaitionMessage(?string $invitaitionMessage): self
    {
        $this->invitaitionMessage = $invitaitionMessage;

        return $this;
    }

    public function getReminderMessage(): ?string
    {
        return $this->reminderMessage;
    }

    public function setReminderMessage(?string $reminderMessage): self
    {
        $this->reminderMessage = $reminderMessage;

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getTranslatableLocale(){
        return $this->locale;
    }
}
