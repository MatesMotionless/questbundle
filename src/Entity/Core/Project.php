<?php

namespace Greendot\QuestBundle\Entity\Core;

use Greendot\QuestBundle\Entity\Repository\Core\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $domain;

    #[ORM\Column(type: 'string', length: 100)]
    private $db_user;

    #[ORM\Column(type: 'string', length: 100)]
    private $db_name;

    #[ORM\Column(type: 'string', length: 255)]
    private $db_password;



    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
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

    public function getDbUser(): ?string
    {
        return $this->db_user;
    }

    public function setDbUser(string $db_user): self
    {
        $this->db_user = $db_user;

        return $this;
    }

    public function getDbName(): ?string
    {
        return $this->db_name;
    }

    public function setDbName(string $db_name): self
    {
        $this->db_name = $db_name;

        return $this;
    }

    public function getDbPassword(): ?string
    {
        return $this->db_password;
    }

    public function setDbPassword(string $db_password): self
    {
        $this->db_password = $db_password;

        return $this;
    }




}
