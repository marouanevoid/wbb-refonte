<?php

namespace WBB\BarBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use WBB\BarBundle\Event\TipEvent;
use WBB\BarBundle\TipsEvents;

class TipsListener implements EventSubscriberInterface
{

    private $container;
    private $mailer;
    private $router;
    private $twig;
    private $em;

    public function __construct($container, $mailer, $router, $twig, $em)
    {
        $this->container = $container;
        $this->mailer = $mailer;
        $this->router = $router;
        $this->twig = $twig;
        $this->em = $em;
    }

    public function sendMail(TipEvent $event)
    {
        if ($event->getTip()->getStatus() == 0) {
            $admins = $this->em->getRepository('WBBUserBundle:User')->findAdminUsers();
            $tip = $event->getTip();
            $tipUrl = $this->router->generate('admin_wbb_bar_tip_edit', array('id' => $tip->getId()), true);

            foreach ($admins as $admin) {
                $data = array(
                    'context' => array(
                        'user' => $admin,
                        'tipUrl' => $tipUrl
                    ),
                    'fromEmail' => array($this->container->getParameter('mailer_email') => $this->container->getParameter('mailer_username')),
                    'toEmail' => $admin->getEmail()
                );

                $templateName = 'WBBBarBundle:Tips:email.html.twig';
                $context = $this->twig->mergeGlobals($data['context']);
                $template = $this->twig->loadTemplate($templateName);
                $subject = $template->renderBlock('subject', $context);
                $textBody = $template->renderBlock('body_text', $context);
                $htmlBody = $template->renderBlock('body_html', $context);

                $message = \Swift_Message::newInstance()
                        ->setSubject($subject)
                        ->setFrom($data['fromEmail'])
                        ->setTo($data['toEmail']);

                if (!empty($htmlBody)) {
                    $message->setBody($htmlBody, 'text/html')
                            ->addPart($textBody, 'text/plain');
                } else {
                    $message->setBody($textBody);
                }

                $this->mailer->send($message);
            }
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            TipsEvents::TIP_CREATED => 'sendMail'
        );
    }

}
