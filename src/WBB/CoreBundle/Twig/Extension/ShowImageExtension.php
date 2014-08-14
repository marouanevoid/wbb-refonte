<?php

namespace WBB\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\MediaBundle\Twig\TokenParser\MediaTokenParser;
use Sonata\MediaBundle\Twig\TokenParser\ThumbnailTokenParser;
use Sonata\MediaBundle\Twig\TokenParser\PathTokenParser;
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
        );
    }

    public function showImageFunction($media = null, $format)
    {
        $defaultSize = $format;
        $media = $this->getMedia($media);
        if (!$media) {
            return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$defaultSize.'.jpg_');//return '';
        }
        $provider = $this->getMediaService()
            ->getProvider($media->getProviderName());
        $format = $provider->getFormatName($media, $format);
        $path =  $provider->generatePublicUrl($media, $format);

        // Define the path to look for
        $pathToCheck = realpath($this->container->get('kernel')->getRootDir() . '/../web/') . $path;
        // If the path does not exist, return the fallback image
        if (!@getimagesize($pathToCheck) || $path == "/"){
            return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default/default_'.$defaultSize.'.jpg_');
        }
        // Return the real image
        return $this->container->get('templating.helper.assets')->getUrl($path);
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