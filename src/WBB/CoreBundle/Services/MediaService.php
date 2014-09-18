<?php
namespace WBB\CoreBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Aws\S3\S3Client;

class MediaService
{
    private $container;
    private $awsS3Bucket;
    private $awsS3Key;
    private $awsS3Secret;

    public function __construct(ContainerInterface $container, $s3Bucket, $s3Key, $s3Secret)
    {
        $this->container = $container;
        $this->awsS3Bucket = $s3Bucket;
        $this->awsS3Key = $s3Key;
        $this->awsS3Secret = $s3Secret;
    }

    public function resize($mediaPath, $options = array())
    {

    }

    public function upload($mediaPath, $filters = array())
    {
        $client = S3Client::factory(array(
            'key'    => $this->awsS3Key,
            'secret' => $this->awsS3Secret
        ));

        //Generate thumbnails and upload each to S3


        $client->putObject(array(
            'Bucket' => $this->awsS3Bucket,
            'Key'    => 'imgtest.jpg',
            'Body'   => fopen($mediaPath, 'r+')
        ));
    }
} 