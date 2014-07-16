<?php

namespace WBB\BarBundle\Mailer;

class TipsMailer
{

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendTipEmail($data)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('WBB : A tip is created')
            ->setFrom($data['fromEmail'])
            ->setTo($data['toEmail'])
            ->setBody('Tip created !');

        $this->mailer->send($message);
    }

}
