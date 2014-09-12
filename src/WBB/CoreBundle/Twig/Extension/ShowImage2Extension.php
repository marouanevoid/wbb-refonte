<?php

namespace WBB\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Sonata\CoreBundle\Model\ManagerInterface;
use Sonata\MediaBundle\Model\MediaInterface;
use Sonata\MediaBundle\Provider\Pool;
use Twig_SimpleFunction;

class ShowImage2Extension extends \Twig_Extension
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
            new Twig_SimpleFunction('showImage2', array($this, 'showImage2Function')),
        );
    }

    public function showImage2Function($filename, $filter)
    {
        $imagineService = $this->container->get('liip_imagine.cache.manager');
        return $imagineService->getBrowserPath($filename, $filter);
    }

    public function getName()
    {
        return 'showImage2';
    }

    /**
     * @return \Sonata\MediaBundle\Provider\Pool
     */
    public function getMediaService()
    {
        return $this->mediaService;
    }
}
