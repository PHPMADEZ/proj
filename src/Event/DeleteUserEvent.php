<?php

namespace App\Event;

use App\Entity\AdminLog;
use Symfony\Contracts\EventDispatcher\Event;

class DeleteUserEvent extends Event
{
    private Adminlog $admin;

    public function __construct($admin)
    {
        $this->admin = $admin;
    }


    public function getUser()
    {
        return $this->admin;
    }

}