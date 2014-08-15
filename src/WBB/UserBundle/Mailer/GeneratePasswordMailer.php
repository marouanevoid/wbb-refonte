<?php

namespace WBB\UserBundle\Mailer;

use WBB\CoreBundle\Mailer\TwigSwiftMailer as BaseTwigSwiftMailer;

/**
 * HospitalisationMailer
 */
class GeneratePasswordMailer extends BaseTwigSwiftMailer
{
    public function sendGeneratedPassword($data)
    {
        $context = array(
            'subject'   => "New Password - World's Best Bars",
            'gender'    => $data['gender'],
            'fullName'  => $data['fullName'],
            'password'  => $data['password'],
            'email'     => $data['email']
        );

        $this->sendMessage(
            'WBBUserBundle:Admin:Email/new-password.email.twig',
            $context,
            null,
            $data['email']
        );
    }
}
