<?php

namespace WBB\UserBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;

class ConfirmationListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_CONFIRM => 'setConfirmed'
        );
    }

    public function setConfirmed(GetResponseUserEvent $event)
    {
        $user = $event->getUser();
        $user->setConfirmed(true);
    }

}
