<?php

namespace WBB\BarBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use WBB\BarBundle\TipsEvents;

class TipsListener implements EventSubscriberInterface
{

    private $mailer;
    private $em;

    public function __construct($mailer, $em)
    {
        $this->mailer = $mailer;
        $this->em = $em;
    }

    public function sendMail($data)
    {
        $admins = $this->em->getRepository('WBBUserBundle:User')->findAdminUsers();

        foreach ($admins as $admin) {
            $data = array(
                'context' => array(),
                'fromEmail' => 'test@test.com',
                'toEmail' => $admin->getEmail()
            );

            $this->mailer->sendTipEmail($data);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            TipsEvents::TIP_CREATED => 'sendMail'
        );
    }

}
