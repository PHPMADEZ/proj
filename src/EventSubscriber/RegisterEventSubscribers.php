<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;

class RegisterEventSubscribers implements EventSubscriberInterface
{
    public function __construct(private MailerInterface $mailer)
    {

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

        if ($entity instanceof User) {
            $email = (new TemplatedEmail())
                ->from(new Address('admin@localhost', 'Admin'))
                ->to($entity->getEmail())
                ->subject('Welcome to the site!')
                ->htmlTemplate('registration/confirmation_email.html.twig')
                ->context([
                    'user' => $entity,
                ]);

            $this->mailer->send($email);
        }
    }
}
