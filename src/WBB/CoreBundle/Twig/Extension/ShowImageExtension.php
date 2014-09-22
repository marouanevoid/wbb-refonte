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
    private $bucket;

    public function __construct(ContainerInterface $container, $bucket)
    {
        $this->container = $container;
        $this->bucket = $bucket;
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

            $originalFilePath = 'https://s3.amazonaws.com/'.$this->bucket.'/uploads/'.$this->getOriginalUploadDir($filter).'/'.$filename;

            // If the path does not exist, return the fallback image
            if (!@getimagesize($originalFilePath) || $path == "/") {
                return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$filter.'.jpeg');
            }

            return $path;
        }

        return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$filter.'.jpeg');
    }

    public function getName()
    {
        return 'showImage';
    }

    private function getOriginalUploadDir($filter)
    {
        $formatParts = explode('_', $filter);

        switch ($formatParts[0]) {
            case "avatar":
                return 'avatars';
                break;

            case "bar":
                return "bars";
                break;

            case "city":
                return "cities";
                break;

            case "bestof":
                return "bestofs";
                break;

            case "news":
                return "news";
                break;

            case "ads":
                return "ads";
                break;

            case "sponsor":
                return "sponsors";
                break;
        }

        return '';
    }
}
