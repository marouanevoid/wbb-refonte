<?php

namespace WBB\CoreBundle\Mailer;

use FOS\UserBundle\Mailer\TwigSwiftMailer as BaseTwigSwiftMailer;

/**
 * TwigSwiftMailer
 */
class TwigSwiftMailer extends BaseTwigSwiftMailer
{

    protected $container;

    /**
     * @param string $templateName
     * @param array  $context
     * @param string $fromEmail
     * @param string $toEmail
     */
    protected function sendMessage($templateName, $context, $fromEmail, $toEmail)
    {
        $context = array_merge($context, $this->twig->getGlobals());

        $template  = $this->twig->loadTemplate($templateName);
        $subject   = $template->renderBlock('subject', $context);
        $textBody  = $template->renderBlock('body_text', $context);
        $htmlBody  = $template->renderBlock('body_html', $context);
        $fromEmail = array($this->container->getParameter('mailer_email') => $this->container->getParameter('mailer_username'));

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($fromEmail)
            ->setTo($toEmail);

        if (!empty($htmlBody)) {
            $message->setBody($htmlBody, 'text/html')
                ->addPart($textBody, 'text/plain');
        } else {
            $message->setBody($textBody);
        }

        $this->mailer->send($message);
    }

    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }
}
