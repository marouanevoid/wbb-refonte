<?php

namespace WBB\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
use Twig_SimpleFunction;

class ShowImageExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('showImage', array($this, 'showImageFunction')),
        );
    }

    public function showImageFunction($filename, $filter, $user = null)
    {
        $formatParts = explode('_', $filter);
        if ($formatParts[0] == 'avatar' && !$filename) {
            if ($user) {
                if ($user->getFacebookPicture()) {
                    return $user->getFacebookPicture();
                }
            }
        }

        if($filename){
            $imagineService = $this->container->get('liip_imagine.cache.manager');
            $path = $imagineService->getBrowserPath($filename, $filter);

//            // If the path does not exist, return the fallback image
//            if (!@getimagesize($path) || $path == "/") {
//                return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$filter.'.jpeg');
//            }

            return $path;
        }

        return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$filter.'.jpeg');
    }

    public function getName()
    {
        return 'showImage';
    }
}
