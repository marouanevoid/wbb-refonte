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
        try{
            $response = $this->bitly->Shorten(array("longUrl" => $path));
            return $response['url'];
        }catch (\Exception $e){
            return $path;
        }

    }

    public function getName()
    {
        return 'bitly';
    }
}