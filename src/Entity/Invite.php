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

    private ?string $user = null;

    #[ORM\Column]
    private ?bool $confirmed = false;
    #[ORM\Column(length: 1)]
    private ?int $isUsed = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $doc = null;

    #[ORM\Column(length: 255)]
    private ?string $userid = null;



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

    /**
     * @return string|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string|null $user
     * @return Invite
     */
    public function setUser(?string $user): Invite
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

    //insert new invite \
    public function insertInvite($invitecode, $userid, $isUsed, $doc, $confirmed)
    {
        $this->setInvitecode($invitecode);
        $this->setUserid($userid);
        $this->setIsUsed($isUsed);
        $this->setDoc($doc);
        $this->setConfirmed($confirmed);
    }

    public function getUserid(): ?string
    {
        return $this->userid;
    }

    public function setUserid(string $userid): self
    {
        $this->userid = $userid;

        return $this;
    }




}
