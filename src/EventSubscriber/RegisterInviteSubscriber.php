<?php

namespace App\EventSubscriber;

use App\Repository\AdminLogRepository;
use App\Repository\InvitesRepository;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class RegisterInviteSubscriber implements EventSubscriberInterface
{

    public function __construct(private InvitesRepository $invitesRepository, private AdminLogRepository $adminLogRepository)
    {


    }



    public static function getSubscribedEvents() : array
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {


        print("hello world");
    }




}