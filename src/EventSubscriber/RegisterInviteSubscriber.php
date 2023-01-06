<?php

namespace App\EventSubscriber;

use App\Entity\Admin;
use App\Entity\AdminLog;
use App\Entity\Invite;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class RegisterInviteSubscriber implements EventSubscriberInterface
{

    public function __construct()
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

        $entity = $args->getObject();

        if ($entity instanceof AdminLog) {
            $entity->setNaam('test');
            $entity->setDescription('test');
            $entity->setUser('test');
            $entity->setDate(new \DateTime());
        }
    }




}