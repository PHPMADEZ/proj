<?php

namespace App\Event;

use App\Entity\Admin;
use App\Entity\Invite;
use Symfony\Contracts\EventDispatcher\Event;
class RegisterInviteEvent extends Event
{

    public function __construct(private Admin $admin, private Invite $invite)
    {
    }
    public function getUser()
    {
        return $this->admin;
    }
    public function getInvite()
    {
        return $this->invites;
    }

}