<?php

namespace WBB\CoreBundle\Twig\Extension;

class BitlyFilterExtension extends \Twig_Extension
{
    private $bitly;

    public function __construct($bitly)
    {
        $this->bitly = $bitly;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('bitly', array($this, 'bitlyFilter')),
        );
    }

    public function bitlyFilter($path)
    {
        $response = $this->bitly->Shorten(array("longUrl" => $path));
        return $response['url'];
    }

    public function getName()
    {
        return 'bitly';
    }
}