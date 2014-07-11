<?php

namespace WBB\CoreBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ShowMediaExtension extends \Twig_Extension
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            'show_media' => new \Twig_Function_Method($this, 'show_media'),
        );
    }

    /**
     * Get the path to an asset. If it does not exist, return the path to the
     * fallback path.
     *
     * @param string $path the path to the asset to display
     * @return string path
     */
    public function show_media($path)
    {
        // Define the path to look for
        $pathToCheck = realpath($this->container->get('kernel')->getRootDir() . '/../web/') . '/' . $path;

        // If the path does not exist, return the fallback image
        if (!file_exists($pathToCheck))
        {
            return $this->container->get('templating.helper.assets')->getUrl('bar-default.jpg');
        }

        // Return the real image
        return $this->container->get('templating.helper.assets')->getUrl($path);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'show_media';
    }
}