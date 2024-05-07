<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table]
#[ORM\Index(columns: ['send_id'], name: 'send_idx')]
#[ORM\Index(columns: ['remind_id'], name: 'remind_idx')]
#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $hash;

    #[ORM\Column(type: 'string', length: 20)]
    private $state;

    #[ORM\Column(type: 'datetime')]
    private $date_submit;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_until;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_reminder;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_opened;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_updated;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date_completed;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $surname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $phone;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $vocative;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $external_id;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $gender;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_1;

    #[ORM\ManyToOne(targetEntity: Quest::class, inversedBy: 'contacts')]
    private $quest;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Answer::class, orphanRemoval: true)]
    private $answers;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $is_test;

    #[ORM\Column(type: 'integer')]
    private $state_ex;

    #[ORM\Column(type: 'string', nullable: true)]
    private $state_send;

    #[ORM\Column(type: 'string', nullable: true)]
    private $state_remind;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $state_sms;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $state_sms_remind;

    #[ORM\OneToMany(mappedBy: 'contact', targetEntity: Update::class)]
    private $updates;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_2;

    #[ORM\Column(type: 'json', nullable: true)]
    private $param_json = [];

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_3;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_4;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_5;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_6;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_7;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_8;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_9;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_10;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $param_11;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $language;

    #[ORM\OneToMany(targetEntity: Log::class, mappedBy: 'contact')]
    private $logs;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $send_id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $remind_id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $client_ip;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $UA_device_type;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $UA_browser;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $UA_operating_system;

    #[ORM\Column(nullable: true)]
    private ?int $smsProjectId = null;

    #[ORM\Column(nullable: true, options: ['default' => 0])]
    private ?bool $isDummy = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_12 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_13 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_14 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_15 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_16 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_17 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_18 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_19 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_20 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $param_21 = null;
    #[ORM\ManyToOne(inversedBy: 'contacts')]
    private ?MailVariant $mailVariant = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $content_class = null;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
        $this->updates = new ArrayCollection();
        $this->logs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDateSubmit(): ?\DateTimeInterface
    {
        return $this->date_submit;
    }

    public function setDateSubmit(\DateTimeInterface $date_submit): self
    {
        $this->date_submit = $date_submit;

        return $this;
    }

    public function getDateUntil(): ?\DateTimeInterface
    {
        return $this->date_until;
    }

    public function setDateUntil(?\DateTimeInterface $date_until): self
    {
        $this->date_until = $date_until;

        return $this;
    }

    public function getDateReminder(): ?\DateTimeInterface
    {
        return $this->date_reminder;
    }

    public function setDateReminder(?\DateTimeInterface $date_reminder): self
    {
        $this->date_reminder = $date_reminder;

        return $this;
    }

    public function getDateOpened(): ?\DateTimeInterface
    {
        return $this->date_opened;
    }

    public function setDateOpened(?\DateTimeInterface $date_opened): self
    {
        $this->date_opened = $date_opened;

        return $this;
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->date_updated;
    }

    public function setDateUpdated(?\DateTimeInterface $date_updated): self
    {
        $this->date_updated = $date_updated;

        return $this;
    }

    public function getDateCompleted(): ?\DateTimeInterface
    {
        return $this->date_completed;
    }

    public function setDateCompleted(?\DateTimeInterface $date_completed): self
    {
        $this->date_completed = $date_completed;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getVocative(): ?string
    {
        return $this->vocative;
    }

    public function setVocative(?string $vocative): self
    {
        $this->vocative = $vocative;

        return $this;
    }

    public function getExternalId(): ?string
    {
        return $this->external_id;
    }

    public function setExternalId(?string $external_id): self
    {
        $this->external_id = $external_id;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getParam1(): ?string
    {
        return $this->param_1;
    }

    public function setParam1(?string $param_1): self
    {
        $this->param_1 = $param_1;

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
            $answer->setContact($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getContact() === $this) {
                $answer->setContact(null);
            }
        }

        return $this;
    }

    public function getIsTest(): ?bool
    {
        return $this->is_test;
    }

    public function setIsTest(?bool $is_test): self
    {
        $this->is_test = $is_test;

        return $this;
    }

    public function getStateEx(): ?int
    {
        return $this->state_ex;
    }

    public function setStateEx(int $state_ex): self
    {
        $this->state_ex = $state_ex;

        return $this;
    }

    public function getStateSend(): ?string
    {
        return $this->state_send;
    }

    public function setStateSend(?string $state_send): self
    {
        $this->state_send = $state_send;

        return $this;
    }

    public function getStateRemind(): ?string
    {
        return $this->state_remind;
    }

    public function setStateRemind(?string $state_remind): self
    {
        $this->state_remind = $state_remind;

        return $this;
    }

    public function getStateSms(): ?string
    {
        return $this->state_sms;
    }

    public function setStateSms(?string $state_sms): self
    {
        $this->state_sms = $state_sms;

        return $this;
    }

    public function getStateSmsRemind(): ?string
    {
        return $this->state_sms_remind;
    }

    public function setStateSmsRemind(?string $state_sms_remind): self
    {
        $this->state_sms_remind = $state_sms_remind;

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
            $update->setContact($this);
        }

        return $this;
    }

    public function removeUpdate(Update $update): self
    {
        if ($this->updates->removeElement($update)) {
            // set the owning side to null (unless already changed)
            if ($update->getContact() === $this) {
                $update->setContact(null);
            }
        }

        return $this;
    }

    public function getParam2(): ?string
    {
        return $this->param_2;
    }

    public function setParam2(?string $param_2): self
    {
        $this->param_2 = $param_2;

        return $this;
    }

    public function getParamJson(): ?array
    {
        return $this->param_json;
    }

    public function setParamJson(?array $param_json): self
    {
        $this->param_json = $param_json;

        return $this;
    }

    public function getParam3(): ?string
    {
        return $this->param_3;
    }

    public function setParam3(?string $param_3): self
    {
        $this->param_3 = $param_3;

        return $this;
    }

    public function getParam4(): ?string
    {
        return $this->param_4;
    }

    public function setParam4(?string $param_4): self
    {
        $this->param_4 = $param_4;

        return $this;
    }

    public function getParam5(): ?string
    {
        return $this->param_5;
    }

    public function setParam5(?string $param_5): self
    {
        $this->param_5 = $param_5;

        return $this;
    }

    public function getParam6(): ?string
    {
        return $this->param_6;
    }

    public function setParam6(?string $param_6): self
    {
        $this->param_6 = $param_6;

        return $this;
    }

    public function getParam7(): ?string
    {
        return $this->param_7;
    }

    public function setParam7(?string $param_7): self
    {
        $this->param_7 = $param_7;

        return $this;
    }

    public function getParam8(): ?string
    {
        return $this->param_8;
    }

    public function setParam8(?string $param_8): self
    {
        $this->param_8 = $param_8;

        return $this;
    }

    public function getParam9(): ?string
    {
        return $this->param_9;
    }

    public function setParam9(?string $param_9): self
    {
        $this->param_9 = $param_9;

        return $this;
    }

    public function getParam10(): ?string
    {
        return $this->param_10;
    }

    public function setParam10(?string $param_10): self
    {
        $this->param_10 = $param_10;

        return $this;
    }

    public function getParam11(): ?string
    {
        return $this->param_11;
    }

    public function setParam11(?string $param_11): self
    {
        $this->param_11 = $param_11;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return Collection|Log[]
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }

    public function addLog(Log $log): self
    {
        if (!$this->logs->contains($log)) {
            $this->logs[] = $log;
            $log->setContact($this);
        }

        return $this;
    }

    public function removeLog(Log $log): self
    {
        if ($this->logs->removeElement($log)) {
            // set the owning side to null (unless already changed)
            if ($log->getContact() === $this) {
                $log->setContact(null);
            }
        }

        return $this;
    }

    public function getSendId(): ?string
    {
        return $this->send_id;
    }

    public function setSendId(?string $send_id): self
    {
        $this->send_id = $send_id;

        return $this;
    }

    public function getRemindId(): ?string
    {
        return $this->remind_id;
    }

    public function setRemindId(?string $remind_id): self
    {
        $this->remind_id = $remind_id;

        return $this;
    }

    public function getClientIp(): ?string
    {
        return $this->client_ip;
    }

    public function setClientIp(?string $client_ip): self
    {
        $this->client_ip = $client_ip;

        return $this;
    }

    public function getUADeviceType(): ?string
    {
        return $this->UA_device_type;
    }

    public function setUADeviceType(?string $UA_device_type): self
    {
        $this->UA_device_type = $UA_device_type;

        return $this;
    }

    public function getUABrowser(): ?string
    {
        return $this->UA_browser;
    }

    public function setUABrowser(?string $UA_browser): self
    {
        $this->UA_browser = $UA_browser;

        return $this;
    }

    public function getUAOperatingSystem(): ?string
    {
        return $this->UA_operating_system;
    }

    public function setUAOperatingSystem(?string $UA_operating_system): self
    {
        $this->UA_operating_system = $UA_operating_system;

        return $this;
    }

    public function getSmsProjectId(): ?int
    {
        return $this->smsProjectId;
    }

    public function setSmsProjectId(?int $smsProjectId): self
    {
        $this->smsProjectId = $smsProjectId;

        return $this;
    }

    public function isIsDummy(): ?bool
    {
        return $this->isDummy;
    }

    public function setIsDummy(?bool $isDummy): self
    {
        $this->isDummy = $isDummy;

        return $this;
    }

    public function getParam12(): ?string
    {
        return $this->param_12;
    }

    public function setParam12(?string $param_12): self
    {
        $this->param_12 = $param_12;

        return $this;
    }

    public function getParam13(): ?string
    {
        return $this->param_13;
    }

    public function setParam13(?string $param_13): self
    {
        $this->param_13 = $param_13;

        return $this;
    }

    public function getParam14(): ?string
    {
        return $this->param_14;
    }

    public function setParam14(?string $param_14): self
    {
        $this->param_14 = $param_14;

        return $this;
    }

    public function getParam15(): ?string
    {
        return $this->param_15;
    }

    public function setParam15(?string $param_15): self
    {
        $this->param_15 = $param_15;

        return $this;
    }

    public function getParam16(): ?string
    {
        return $this->param_16;
    }

    public function setParam16(?string $param_16): self
    {
        $this->param_16 = $param_16;

        return $this;
    }

    public function getParam17(): ?string
    {
        return $this->param_17;
    }

    public function setParam17(?string $param_17): self
    {
        $this->param_17 = $param_17;

        return $this;
    }

    public function getParam18(): ?string
    {
        return $this->param_18;
    }

    public function setParam18(?string $param_18): self
    {
        $this->param_18 = $param_18;

        return $this;
    }

    public function getParam19(): ?string
    {
        return $this->param_19;
    }

    public function setParam19(?string $param_19): self
    {
        $this->param_19 = $param_19;

        return $this;
    }

    public function getParam20(): ?string
    {
        return $this->param_20;
    }

    public function setParam20(?string $param_20): self
    {
        $this->param_20 = $param_20;

        return $this;
    }

    public function getParam21(): ?string
    {
        return $this->param_21;
    }

    public function setParam21(?string $param_21): self
    {
        $this->param_21 = $param_21;

        return $this;
    }

    public function getMailVariant(): ?MailVariant
    {
        return $this->mailVariant;
    }

    public function setMailVariant(?MailVariant $mailVariant): self
    {
        $this->mailVariant = $mailVariant;

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
}
