<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\QuestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

#[ORM\Entity(repositoryClass: QuestRepository::class)]
class Quest implements Translatable
{
    const MAILER_NONE = 0;
    const MAILER_ACCELERATE = 1;
    const MAILER_MAILGUN = 2;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 150)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $domain;

    #[ORM\Column(type: 'integer')]
    private $ask_after;

    #[ORM\Column(type: 'integer')]
    private $remind_after;

    #[ORM\Column(type: 'integer')]
    private $expires_after;

    #[ORM\Column(type: 'integer')]
    private $quaranteen_days;


    #[ORM\Column(type: 'boolean')]
    private $is_click_to_continue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $from_name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $from_mail;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subject_mail;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $subject_reminder;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $mail_template;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $reminder_template;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_export;

    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'quest')]
    private $questions;

    #[ORM\OneToMany(targetEntity: Contact::class, mappedBy: 'quest')]
    private $contacts;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $content_class;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $is_percent_progress;

    #[ORM\OneToMany(targetEntity: QuestLanguage::class, mappedBy: 'quest')]
    private $questLanguages;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $mail_type;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $mail_reminder_type;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $has_sms;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $sending_priority;

    #[ORM\OneToMany(targetEntity: Quarantine::class, mappedBy: 'quest')]
    private $quarantines;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $has_sms_reminder;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    private $reminder_priority;

    #[ORM\OneToMany(targetEntity: Update::class, mappedBy: 'quest')]
    private $updates;


    #[ORM\Column(type: 'smallint')]
    private $is_active;

    #[ORM\Column(type: 'string', length: 255)]
    private $favicon;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $acc_project;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $acc_login;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $acc_password;

    #[ORM\OneToMany(targetEntity: Page::class, mappedBy: 'quest', orphanRemoval: true)]
    private $pages;

   #[Gedmo\Locale]
    private $locale;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'text', nullable: true)]
    private $sms_text;

    #[Gedmo\Translatable]
    #[ORM\Column(type: 'text', nullable: true)]
    private $sms_text_reminder;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $sms_project_id;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $hasParameters;

    #[ORM\OneToMany(mappedBy: 'Quest', targetEntity: SmsTemplate::class)]
    private Collection $smsTemplates;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $slug = null;

    #[ORM\Column]
    private ?bool $isInfinity = null;

    #[ORM\OneToMany(mappedBy: 'quest', targetEntity: Whitelist::class, orphanRemoval: true)]
    private Collection $whitelists;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail_api_key = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $mail_api_domain = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $mail_domain = null;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->questLanguages = new ArrayCollection();
        $this->quarantines = new ArrayCollection();
        $this->updates = new ArrayCollection();
        $this->smsTemplates = new ArrayCollection();
        $this->whitelists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    public function getAskAfter(): ?int
    {
        return $this->ask_after;
    }

    public function setAskAfter(int $ask_after): self
    {
        $this->ask_after = $ask_after;

        return $this;
    }

    public function getRemindAfter(): ?int
    {
        return $this->remind_after;
    }

    public function setRemindAfter(int $remind_after): self
    {
        $this->remind_after = $remind_after;

        return $this;
    }

    public function getExpiresAfter(): ?int
    {
        return $this->expires_after;
    }

    public function setExpiresAfter(int $expires_after): self
    {
        $this->expires_after = $expires_after;

        return $this;
    }

    public function getQuaranteenDays(): ?int
    {
        return $this->quaranteen_days;
    }

    public function setQuaranteenDays(int $quaranteen_days): self
    {
        $this->quaranteen_days = $quaranteen_days;

        return $this;
    }

    public function getIsReminder(): ?bool
    {
        return $this->is_reminder;
    }

    public function setIsReminder(bool $is_reminder): self
    {
        $this->is_reminder = $is_reminder;

        return $this;
    }

    public function getIsSubmit(): ?bool
    {
        return $this->is_submit;
    }

    public function setIsSubmit(bool $is_submit): self
    {
        $this->is_submit = $is_submit;

        return $this;
    }

    public function getIsClickToContinue(): ?bool
    {
        return $this->is_click_to_continue;
    }

    public function setIsClickToContinue(bool $is_click_to_continue): self
    {
        $this->is_click_to_continue = $is_click_to_continue;

        return $this;
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

    public function getDateExport(): ?\DateTimeInterface
    {
        return $this->date_export;
    }

    public function setDateExport(?\DateTimeInterface $date_export): self
    {
        $this->date_export = $date_export;

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
            $question->setQuest($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getQuest() === $this) {
                $question->setQuest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setQuest($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getQuest() === $this) {
                $contact->setQuest(null);
            }
        }

        return $this;
    }

    public function getContentClass(): ?string
    {
        return $this->content_class;
    }

    public function setContentClass(?string $content_class): self
    {
        $this->content_class = $content_class;

        return $this;
    }

    public function getIsPercentProgress(): ?bool
    {
        return $this->is_percent_progress;
    }

    public function setIsPercentProgress(?bool $is_percent_progress): self
    {
        $this->is_percent_progress = $is_percent_progress;

        return $this;
    }

    /**
     * @return Collection|QuestLanguage[]
     */
    public function getQuestLanguages(): Collection
    {
        return $this->questLanguages;
    }

    public function addQuestLanguage(QuestLanguage $questLanguage): self
    {
        if (!$this->questLanguages->contains($questLanguage)) {
            $this->questLanguages[] = $questLanguage;
            $questLanguage->setQuest($this);
        }

        return $this;
    }

    public function removeQuestLanguage(QuestLanguage $questLanguage): self
    {
        if ($this->questLanguages->removeElement($questLanguage)) {
            // set the owning side to null (unless already changed)
            if ($questLanguage->getQuest() === $this) {
                $questLanguage->setQuest(null);
            }
        }

        return $this;
    }

    public function getMailType(): ?int
    {
        return $this->mail_type;
    }

    public function setMailType(?int $mail_type): self
    {
        $this->mail_type = $mail_type;

        return $this;
    }

    public function getMailReminderType(): ?int
    {
        return $this->mail_reminder_type;
    }

    public function setMailReminderType(?int $mail_reminder_type): self
    {
        $this->mail_reminder_type = $mail_reminder_type;

        return $this;
    }

    public function getHasSms(): ?bool
    {
        return $this->has_sms;
    }

    public function setHasSms(?bool $has_sms): self
    {
        $this->has_sms = $has_sms;

        return $this;
    }

    public function getSendingPriority(): ?string
    {
        return $this->sending_priority;
    }

    public function setSendingPriority(?string $sending_priority): self
    {
        $this->sending_priority = $sending_priority;

        return $this;
    }

    /**
     * @return Collection|Quarantine[]
     */
    public function getQuarantines(): Collection
    {
        return $this->quarantines;
    }

    public function addQuarantine(Quarantine $quarantine): self
    {
        if (!$this->quarantines->contains($quarantine)) {
            $this->quarantines[] = $quarantine;
            $quarantine->setQuest($this);
        }

        return $this;
    }

    public function removeQuarantine(Quarantine $quarantine): self
    {
        if ($this->quarantines->removeElement($quarantine)) {
            // set the owning side to null (unless already changed)
            if ($quarantine->getQuest() === $this) {
                $quarantine->setQuest(null);
            }
        }

        return $this;
    }

    public function getHasSmsReminder(): ?bool
    {
        return $this->has_sms_reminder;
    }

    public function setHasSmsReminder(?bool $has_sms_reminder): self
    {
        $this->has_sms_reminder = $has_sms_reminder;

        return $this;
    }

    public function getReminderPriority(): ?string
    {
        return $this->reminder_priority;
    }

    public function setReminderPriority(?string $reminder_priority): self
    {
        $this->reminder_priority = $reminder_priority;

        return $this;
    }

    /**
     * @return Collection|Update[]
     */
    public function getUpdates(): Collection
    {
        return $this->updates;
    }

    public function addUpdate(Update $update): self
    {
        if (!$this->updates->contains($update)) {
            $this->updates[] = $update;
            $update->setQuest($this);
        }

        return $this;
    }

    public function removeUpdate(Update $update): self
    {
        if ($this->updates->removeElement($update)) {
            // set the owning side to null (unless already changed)
            if ($update->getQuest() === $this) {
                $update->setQuest(null);
            }
        }

        return $this;
    }

    public function getIsActive(): ?int
    {
        return $this->is_active;
    }

    public function setIsActive(int $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getFavicon(): ?string
    {
        return $this->favicon;
    }

    public function setFavicon(string $favicon): self
    {
        $this->favicon = $favicon;

        return $this;
    }

    public function getAccProject(): ?string
    {
        return $this->acc_project;
    }

    public function setAccProject(?string $acc_project): self
    {
        $this->acc_project = $acc_project;

        return $this;
    }

    public function getAccLogin(): ?string
    {
        return $this->acc_login;
    }

    public function setAccLogin(?string $acc_login): self
    {
        $this->acc_login = $acc_login;

        return $this;
    }

    public function getAccPassword(): ?string
    {
        return $this->acc_password;
    }

    public function setAccPassword(?string $acc_password): self
    {
        $this->acc_password = $acc_password;

        return $this;
    }

    /**
     * @return Collection|Page[]
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages[] = $page;
            $page->setQuest($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getQuest() === $this) {
                $page->setQuest(null);
            }
        }

        return $this;
    }

    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

    public function getSmsText(): ?string
    {
        return $this->sms_text;
    }

    public function setSmsText(?string $sms_text): self
    {
        $this->sms_text = $sms_text;

        return $this;
    }

    public function getSmsTextReminder(): ?string
    {
        return $this->sms_text_reminder;
    }

    public function setSmsTextReminder(?string $sms_text_reminder): self
    {
        $this->sms_text_reminder = $sms_text_reminder;

        return $this;
    }

    public function getSmsProjectId(): ?int
    {
        return $this->sms_project_id;
    }

    public function setSmsProjectId(?int $sms_project_id): self
    {
        $this->sms_project_id = $sms_project_id;

        return $this;
    }

    public function getHasParameters(): ?bool
    {
        return $this->hasParameters;
    }

    public function setHasParameters(?bool $hasParameters): self
    {
        $this->hasParameters = $hasParameters;

        return $this;
    }

    /**
     * @return Collection<int, SmsTemplate>
     */
    public function getSmsTemplates(): Collection
    {
        return $this->smsTemplates;
    }

    public function addSmsTemplate(SmsTemplate $smsTemplate): self
    {
        if (!$this->smsTemplates->contains($smsTemplate)) {
            $this->smsTemplates->add($smsTemplate);
            $smsTemplate->setQuest($this);
        }

        return $this;
    }

    public function removeSmsTemplate(SmsTemplate $smsTemplate): self
    {
        if ($this->smsTemplates->removeElement($smsTemplate)) {
            // set the owning side to null (unless already changed)
            if ($smsTemplate->getQuest() === $this) {
                $smsTemplate->setQuest(null);
            }
        }

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

    public function isIsInfinity(): ?bool
    {
        return $this->isInfinity;
    }

    public function setIsInfinity(bool $isInfinity): self
    {
        $this->isInfinity = $isInfinity;

        return $this;
    }

    /**
     * @return Collection<int, Whitelist>
     */
    public function getWhitelists(): Collection
    {
        return $this->whitelists;
    }

    public function addWhitelist(Whitelist $whitelist): self
    {
        if (!$this->whitelists->contains($whitelist)) {
            $this->whitelists->add($whitelist);
            $whitelist->setQuest($this);
        }

        return $this;
    }

    public function removeWhitelist(Whitelist $whitelist): self
    {
        if ($this->whitelists->removeElement($whitelist)) {
            // set the owning side to null (unless already changed)
            if ($whitelist->getQuest() === $this) {
                $whitelist->setQuest(null);
            }
        }

        return $this;
    }

    public function getMailApiKey(): ?string
    {
        return $this->mail_api_key;
    }

    public function setMailApiKey(?string $mail_api_key): self
    {
        $this->mail_api_key = $mail_api_key;

        return $this;
    }

    public function getMailApiDomain(): ?string
    {
        return $this->mail_api_domain;
    }

    public function setMailApiDomain(?string $mail_api_domain): self
    {
        $this->mail_api_domain = $mail_api_domain;

        return $this;
    }

    public function getMailDomain(): ?string
    {
        return $this->mail_domain;
    }

    public function setMailDomain(?string $mail_domain): self
    {
        $this->mail_domain = $mail_domain;

        return $this;
    }
}
