<?php

namespace App\EventSubscriber;

use App\Controller\AdminLogController;
use App\Entity\Admin;
use App\Entity\AdminLog;
use App\Controller\AdminController;
use App\Repository\AdminLogRepository;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class DeleteUserSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly TokenStorageInterface $tokenStorage, private  AdminLogRepository $adminLogRepository)
    {
        $this->adminLogRepository = $adminLogRepository;
    }
    public function getSubscribedEvents() : array
    {
        return [
            Events::postRemove,
        ];
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Admin) {
            $admin = new AdminLog();
            $admin->setNaam($entity->getName());
            $admin->setDescription('Deleted');
            $admin->setUser($this->tokenStorage->getToken()->getUser()->getUserIdentifier());
            $admin->setDate(new \DateTime());
            $this->AdminLogRepository->save($admin, true);



        }
    }
}

