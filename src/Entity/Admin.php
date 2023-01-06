<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(targetEntity: Admin::class, mappedBy: 'admins')]
    private $admins;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Invite::class)]
    private Collection $invites;

    public function __construct()
    {
        $this->invites = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     * @return Admin
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return Collection<int, Invite>
     */
    public function getInvites(): Collection
    {
        return $this->invites;
    }

    public function addInvite(Invite $invite): self
    {
        if (!$this->invites->contains($invite)) {
            $this->invites->add($invite);
            $invite->setUser($this);
        }

        return $this;
    }

    public function removeInvite(Invite $invite): self
    {
        if ($this->invites->removeElement($invite)) {
            // set the owning side to null (unless already changed)
            if ($invite->getUser() === $this) {
                $invite->setUser(null);
            }
        }

        return $this;
    }






    
}
