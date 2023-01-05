<?php

namespace App\Entity;

use App\Repository\InvitesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitesRepository::class)]
class Invites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $invitecode = null;

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
}
