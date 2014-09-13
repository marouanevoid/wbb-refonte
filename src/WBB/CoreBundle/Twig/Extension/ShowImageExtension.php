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
    private $mediaService;
    private $mediaManager;

    public function __construct(Pool $mediaService, ManagerInterface $mediaManager, ContainerInterface $container)
    {
        $this->container = $container;
        $this->mediaService = $mediaService;
        $this->mediaManager = $mediaManager;
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('showImage', array($this, 'showImageFunction')),
            new Twig_SimpleFunction('showImage2', array($this, 'showImage2Function')),
        );
    }

    public function showImage2Function($filename, $filter, $user = null)
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

            // If the path does not exist, return the fallback image
            if (!@getimagesize($path) || $path == "/") {
                return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$filter.'.jpeg');
            }

            return $path;
        }

        return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$filter.'.jpeg');
    }

//    public function showImageFunction($media, $format, $user = null)
    public function showImageFunction($filename, $filter, $user = null)
    {
//        $formatParts = explode('_', $format);
//        if ($formatParts[0] == 'avatar' && !$media) {
//            if ($user) {
//                if ($user->getFacebookPicture()) {
//                    return $user->getFacebookPicture();
//                }
//            }
//        }
//
//        $defaultSize = $format;
//        $media = $this->getMedia($media);
//        if (!$media) {
//            return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$defaultSize.'.jpeg');
//        }
//        $provider = $this->getMediaService()
//            ->getProvider($media->getProviderName());
//        $format = $provider->getFormatName($media, $format);
//        $path =  $provider->generatePublicUrl($media, $format);
//
//        // Define the path to look for
//        $pathToCheck = $path;
//        if(strpos($path, "http://") === false) {
//            $pathToCheck = realpath($this->container->get('kernel')->getRootDir() . '/../web/') . $path;
//        }
//
//        // If the path does not exist, return the fallback image
//        if (!@getimagesize($pathToCheck) || $path == "/") {
//            return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$defaultSize.'.jpeg');
//        }
//        // Return the real image
//        return $this->container->get('templating.helper.assets')->getUrl($path);

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

            // If the path does not exist, return the fallback image
            if (!@getimagesize($path) || $path == "/") {
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

    /**
     * @return \Sonata\MediaBundle\Provider\Pool
     */
    public function getMediaService()
    {
        return $this->mediaService;
    }

    /**
     * @param mixed $media
     *
     * @return null|\Sonata\MediaBundle\Model\MediaInterface
     */
    private function getMedia($media)
    {
        if (!$media instanceof MediaInterface && strlen($media) > 0) {
            $media = $this->mediaManager->findOneBy(array(
                'id' => $media
            ));
        }

        if (!$media instanceof MediaInterface) {
            return false;
        }

        if ($media->getProviderStatus() !== MediaInterface::STATUS_OK) {
            return false;
        }

        return $media;
    }
}
