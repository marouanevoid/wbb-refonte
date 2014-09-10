<?php
namespace WBB\CoreBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;

class MediaService
{
    private $container;
    private $awsS3Key;
    private $awsS3Secret;
    private $awsS3Bucket;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->configS3 = array();
    }

    public function resize($mediaPath, $options = array())
    {

    }

    public function upload($mediaPath)
    {

    }
} 