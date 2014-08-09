<?php

namespace WBB\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\Event\FormEvent;

class RegistrationListener implements EventSubscriberInterface
{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'sendProfileEmail'
        );
    }

    public function sendProfileEmail(FormEvent $event)
    {
        $user = $event->getForm()->getData();
        $profileUrl = $this->container->get('router')->generate('fos_user_profile_edit', array(), true);

        $data = array(
            'context' => array(
                'user' => $user,
                'profileUrl' => $profileUrl
            ),
            'fromEmail' => $this->container->getParameter('mailer_email'),
            'toEmail' => $user->getEmail()
        );

        $twig = $this->container->get('twig');
        $templateName = 'WBBUserBundle:User:completeProfile.html.twig';
        $context = $twig->mergeGlobals($data['context']);
        $template = $twig->loadTemplate($templateName);
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

        $this->container->get('mailer')->send($message);
    }

}
