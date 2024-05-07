<?php

namespace Greendot\QuestBundle\Entity\Project;

use Greendot\QuestBundle\Repository\Project\LanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LanguageRepository::class)]
class Language
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $name;

    #[ORM\Column(type: 'string', length: 20)]
    private $locale;

    #[ORM\OneToMany(targetEntity: QuestLanguage::class, mappedBy: 'language')]
    private $questLanguages;

    #[ORM\Column(type: 'boolean')]
    private $is_right_to_left;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $short;

    public function __construct()
    {
        $this->questLanguages = new ArrayCollection();
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

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

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
            $questLanguage->setLanguage($this);
        }

        return $this;
    }

    public function removeQuestLanguage(QuestLanguage $questLanguage): self
    {
        if ($this->questLanguages->removeElement($questLanguage)) {
            // set the owning side to null (unless already changed)
            if ($questLanguage->getLanguage() === $this) {
                $questLanguage->setLanguage(null);
            }
        }

        return $this;
    }

    public function getIsRightToLeft(): ?bool
    {
        return $this->is_right_to_left;
    }

    public function setIsRightToLeft(bool $is_right_to_left): self
    {
        $this->is_right_to_left = $is_right_to_left;

        return $this;
    }

    public function getShort(): ?string
    {
        return $this->short;
    }

    public function setShort(?string $short): self
    {
        $this->short = $short;

        return $this;
    }
}
