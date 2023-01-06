<?php

namespace App\Event;

use App\Entity\Invite;
use Symfony\Contracts\EventDispatcher\Event;
#[ORM\HasLifecycleCallbacks]
class RegisterInviteEvent extends Event
{

    public function __construct(private  Invite $invite)
    {

    }

    public function getInvite(): Invite
    {
        return $this->invite;
    }



}