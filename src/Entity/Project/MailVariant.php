<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\MailVariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: MailVariantRepository::class)]
class MailVariant implements Translatable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $from_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $from_mail = null;

    #[Gedmo\Translatable]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subject_mail = null;

    #[Gedmo\Translatable]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subject_reminder = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail_template = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reminder_template = null;

    #[ORM\OneToMany(mappedBy: 'mailVariant', targetEntity: Contact::class)]
    private Collection $contacts;

    #[Gedmo\Locale]
    private $locale;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $domain = null;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromName(): ?string
    {
        return $this->from_name;
    }

    public function setFromName(?string $from_name): self
    {
        $this->from_name = $from_name;

        return $this;
    }

    public function getFromMail(): ?string
    {
        return $this->from_mail;
    }

    public function setFromMail(?string $from_mail): self
    {
        $this->from_mail = $from_mail;

        return $this;
    }

    public function getSubjectMail(): ?string
    {
        return $this->subject_mail;
    }

    public function setSubjectMail(?string $subject_mail): self
    {
        $this->subject_mail = $subject_mail;

        return $this;
    }

    public function getSubjectReminder(): ?string
    {
        return $this->subject_reminder;
    }

    public function setSubjectReminder(?string $subject_reminder): self
    {
        $this->subject_reminder = $subject_reminder;

        return $this;
    }

    public function getMailTemplate(): ?string
    {
        return $this->mail_template;
    }

    public function setMailTemplate(?string $mail_template): self
    {
        $this->mail_template = $mail_template;

        return $this;
    }

    public function getReminderTemplate(): ?string
    {
        return $this->reminder_template;
    }

    public function setReminderTemplate(?string $reminder_template): self
    {
        $this->reminder_template = $reminder_template;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setMailVariant($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getMailVariant() === $this) {
                $contact->setMailVariant(null);
            }
        }

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(?string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }
}
