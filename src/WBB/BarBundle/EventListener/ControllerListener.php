<?php

namespace WBB\BarBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ControllerListener
{

    private $favoritesManager;

    public function __construct($favoritesManager)
    {
        $this->favoritesManager = $favoritesManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            return;
        }

        $cookies = $event->getRequest()->cookies;

        if ($cookies->has('light_action') && $cookies->has('light_from')) {
            if ($cookies->get('light_action') == 'favorite') {
                $type = $cookies->get('light_type');
                $id = $cookies->get('light_id');

                $this->favoritesManager->addToFavorites($id, $type);
            }
        }
    }

}
