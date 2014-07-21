<?php

namespace WBB\BarBundle\Mailer;

use WBB\CoreBundle\Mailer\TwigSwiftMailer as BaseTwigSwiftMailer;

/**
 * ForumMailer
 */
class NewsMailer extends BaseTwigSwiftMailer
{
    public function sendSharedEmailMessage($dataShare)
    {
        $url = $this->router->generate(
            'bmwi_forum_question_show',
            array(
                'thematic_slug'     => $dataShare['question']->getThematic()->getSlug(),
                'question_slug'     => $dataShare['question']->getSlug()
            ), true
        );

        $context = array(
            'questionUrl' => $url,
            'name'        => $dataShare['name'],
            'friendName'  => $dataShare['friendName'],
            //'message'     => $dataShare['content']
        );

        $this->sendMessage('BMWiForumBundle:Question:Email/share.email.twig', $context, $dataShare['email'], $dataShare['friendEmail']);
    }
}
