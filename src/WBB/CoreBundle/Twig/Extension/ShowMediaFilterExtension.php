<?php

namespace WBB\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ShowMediaFilterExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('showMedia', array($this, 'showMediaFilter')),
        );
    }

    public function showMediaFilter($path)
    {
        // Define the path to look for
        $pathToCheck = realpath($this->container->get('kernel')->getRootDir() . '/../web/') . $path;

        // If the path does not exist, return the fallback image
        if (!@getimagesize($pathToCheck) || $path == "/") {
            return $this->container->get('templating.helper.assets')->getUrl('bundles/wbbcore/images/default.jpg');
        }

        // Return the real image
        return $this->container->get('templating.helper.assets')->getUrl($path);
    }

    public function getName()
    {
        return 'showMedia';
    }
}
