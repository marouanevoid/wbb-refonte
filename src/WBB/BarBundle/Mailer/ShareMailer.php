<?php

namespace WBB\BarBundle\Mailer;

use WBB\CoreBundle\Mailer\TwigSwiftMailer as BaseTwigSwiftMailer;

/**
 * HospitalisationMailer
 */
class ShareMailer extends BaseTwigSwiftMailer
{
    public function sendShareBar($data)
    {
        $context = array(
            'subject'   => "Check ". $data['bar']->getName() ." in ". $data['bar']->getCity() ." via www.worldsbestbars.com",
            'fullName'  => $data['fullName'],
            'bar'       => $data['bar'],
            'email'     => $data['email'],
            'message'   => $data['message']
        );

        $this->sendMessage(
            'WBBBarBundle:Share:Email/bar.email.twig',
            $context,
            null,
            $data['email']
        );
    }

    public function sendShareNews($data)
    {
        $context = array(
            'subject'   => "Check this news ". $data['news']->getTitle() ." on www.worldsbestbars.com",
            'fullName'  => $data['fullName'],
            'news'       => $data['news'],
            'email'     => $data['email'],
            'message'   => $data['message']
        );

        $this->sendMessage(
            'WBBBarBundle:Share:Email/news.email.twig',
            $context,
            null,
            $data['email']
        );
    }
}
