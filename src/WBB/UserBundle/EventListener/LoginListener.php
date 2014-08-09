<?php

namespace WBB\UserBundle\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine;

/**
 * Listener responsible save latitude and longitude to user profile
 */
class LoginListener
{
    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;
    private $container;

    /**
     * Constructor
     *
     * @param SecurityContext $securityContext
     * @param Doctrine $doctrine
     * @param $container
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine, $container)
    {
        $this->securityContext  = $securityContext;
        $this->em               = $doctrine->getManager();
        $this->container        = $container;
    }

    /**
     * Do the magic.
     *
     * @param InteractiveLoginEvent $event
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        if ($this->securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
            // get the logged in user
            $user = $event->getAuthenticationToken()->getUser();
            $session   = $this->container->get('session');
            $latitude  = $session->get('userLatitude');
            $longitude = $session->get('userLongitude');

            $city = $this->container->get('city.repository')->findNearestCity($latitude, $longitude, 150, 0, 1);

            if($city){
                $user->setPrefStartCity($city);
                $user->setCountry($city->getCountry());
                $user->setLatitude($latitude);
                $user->setLongitude($longitude);

                $this->em->persist($user);
                $this->em->flush();
            }
        }
    }
}