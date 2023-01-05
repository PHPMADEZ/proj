<?php

namespace App\Entity;

use App\Repository\InvitesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitesRepository::class)]
class Invite
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $invitecode = null;

    #[ORM\ManyToOne(targetEntity: Admin::class, inversedBy: 'user')]
    private ?Admin $user = null;

    #[ORM\Column]
    private ?bool $confirmed = false;
    #[ORM\Column(length: 1)]
    private ?int $isUsed = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $doc = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvitecode(): ?string
    {
        return $this->invitecode;
    }

    public function setInvitecode(string $invitecode): self
    {
        $this->invitecode = $invitecode;

        return $this;
    }

    public function getDoc(): ?\DateTimeInterface
    {
        return $this->doc;
    }

    public function setDoc(\DateTimeInterface $doc): self
    {
        $this->doc = $doc;

        return $this;
    }


    public function getIsUsed(): ?int
    {
        return $this->isUsed;
    }


    public function setIsUsed(?int $isUsed): Invite
    {
        $this->isUsed = $isUsed;
        return $this;
    }

    public function getUser(): ?Admin
    {
        return $this->user;
    }

    public function setUser(?Admin $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    /**
     * @param bool|null $confirmed
     * @return Invite
     */
    public function setConfirmed(?bool $confirmed): Invite
    {
        $this->confirmed = $confirmed;
        return $this;
    }




}
