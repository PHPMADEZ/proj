<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
class Admin
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $geboortedatum = null;
    
    #[ORM\Column(length: 30)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $telnummer = null;

    #[ORM\OneToMany(targetEntity: AdminLog::class, mappedBy: 'user')]
    private $logs;

    #[ORM\OneToMany(targetEntity: Invite::class, mappedBy: 'user')]
    private $user;




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

    public function getGeboortedatum(): ?\DateTimeInterface
    {
        return $this->geboortedatum;
    }

    public function setGeboortedatum(\DateTimeInterface $geboortedatum): self
    {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelnummer(): ?int
    {
        return $this->telnummer;
    }

    public function setTelnummer(int $telnummer): self
    {
        $this->telnummer = $telnummer;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLogs()
    {
        return $this->logs;
    }

    /**
     * @param mixed $logs
     * @return Admin
     */
    public function setLogs($logs)
    {
        $this->logs = $logs;
        return $this;
    }


    
}
