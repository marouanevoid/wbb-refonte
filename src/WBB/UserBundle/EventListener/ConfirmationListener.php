<?php

namespace WBB\UserBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ConfirmationListener implements EventSubscriberInterface
{

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

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
        if ($user->getFirstname() == '') {
            $this->session->getFlashBag()->add('wbb-complete-profile', true);
        } else {
            $this->session->getFlashBag()->add('wbb-user-confirmed', true);
        }
    }

}
