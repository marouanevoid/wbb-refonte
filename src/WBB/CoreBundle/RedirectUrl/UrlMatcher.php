<?php

namespace WBB\CoreBundle\RedirectUrl;

use Doctrine\Common\Persistence\ObjectManager;

class UrlMatcher
{

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    public function match($url)
    {
        $repo = $this->em->getRepository('WBBCoreBundle:RedirectUrl');
        $matched = $repo->findOneBy(array(
            'source' => $url
        ));
        if ($matched) {
            echo 'yes !';
        }
        die();
    }

}
