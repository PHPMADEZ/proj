<?php

namespace App\EventListener;

use App\Entity\Invite;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

#[AsEntityListener(event: 'prePersist', method: 'prePersist', entity: Invite::class)]
#[AsEntityListener(event: 'postPersist', method: 'postPersist', entity: Invite::class)]
class RegisterInviteListener
{
    public function __construct(private readonly TokenStorageInterface $tokenStorage)
    {
    }

    public function prePersist(Invite $invite, LifecycleEventArgs $args): void
    {
        $invite->setAdmin($this->tokenStorage->getToken()->getUser());
    }

    public function postPersist(Invite $invite, LifecycleEventArgs $args): void
    {

    }
}