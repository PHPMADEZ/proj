<?php

namespace App\EventSubscriber;

use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use App\Repository\InvitesRepository;
use App\Entity\Invites;
use App\Entity\Admin;

class RegisterInviteSubscriber implements EventSubscriberInterface
{
    public function __construct(private InvitesRepository $invitesRepository)
    {
        $this->invitesRepository = $invitesRepository;
    }
    public function getSubscribedEvents() : array
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Admin) {
            $invite = new Invites();

            $invite->setInvitecode($this->invitesRepository->generateInviteCode());
            $invite->setUser($entity);
            $invite->setIsUsed(1);
            $invite->setDoc(new \DateTime());

            $this->invitesRepository->save($invite, true);

        }
    }


}