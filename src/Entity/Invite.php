<?php

namespace App\Entity;

use App\Repository\InvitesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvitesRepository::class)]
class Invite
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $invitecode = '';
    #[ORM\Column(type: 'boolean')]
    private bool $used = false;
    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $doc;
    #[ORM\ManyToOne(targetEntity: User::class)]
    private ?User $admin = null;

    public function __construct()
    {
        $this->doc = new \DateTimeImmutable();
    }

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

    public function getConfirmed(): bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): Invite
    {
        $this->confirmed = $confirmed;
        return $this;
    }

    public function getAdmin(): ?User
    {
        return $this->admin;
    }

    public function setAdmin(?User $admin): Invite
    {
        $this->admin = $admin;
        return $this;
    }

    /**
     * @return bool
     */
    public function isUsed(): bool
    {
        return $this->used;
    }

    /**
     * @param bool $used
     * @return Invite
     */
    public function setUsed(bool $used): Invite
    {
        $this->used = $used;
        return $this;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getDoc(): \DateTimeImmutable
    {
        return $this->doc;
    }

    /**
     * @param \DateTimeImmutable $doc
     * @return Invite
     */
    public function setDoc(\DateTimeImmutable $doc): Invite
    {
        $this->doc = $doc;
        return $this;
    }




}
