<?php

namespace App\EventSubscriber;

use App\Entity\AdminLog;
use App\Entity\Invite;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;


class RegisterInviteSubscriber  implements EventSubscriberInterface
{

    public function __construct(private Invite $invite, private AdminLog $adminLog)
    {
    }


    public function getSubscribedEvents() : array
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist()
    {
        $this->adminLog->setNaam($this->invite->getNaam());
        $this->adminLog->setDescription('Created');
        $this->adminLog->setUser($this->invite->getUser()->getUserIdentifier());
        $this->adminLog->setDate(new \DateTime());
        $this->adminLog->save($this->adminLog, true);
    }




}