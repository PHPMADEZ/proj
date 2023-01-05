<?php

namespace App\Event;

use App\Entity\Admin;
use App\Entity\Invites;
use Symfony\Contracts\EventDispatcher\Event;
class RegisterInviteEvent extends Event
{

    public function __construct(private Admin $admin, private Invites $invites)
    {
        $this->admin = $admin;
        $this->invites = $invites;
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