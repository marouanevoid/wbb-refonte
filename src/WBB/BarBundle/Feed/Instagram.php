<?php

namespace WBB\BarBundle\Feed;

use WBB\BarBundle\Entity\Bar;
use Guzzle\Http\Client;

/**
 * Foursquare
 */
class Instagram implements FeedInterface
{
    private $container;
    private $em;
    private $limit;
    private $client;
    private $clientId;

    protected $baseUrl = "https://api.instagram.com";

    /**
     * __construct
     *
     * @param $container
     * @param $em
     * @param $limit
     * @param $clientId
     */
    public function __construct($container, $em, $limit, $clientId)
    {
        $this->container    = $container;
        $this->em           = $em;
        $this->limit        = $limit;
        $this->client       = new Client($this->baseUrl);
        $this->clientId     = $clientId;
    }

    public function getInstagramID($username)
    {
        $url = "/v1/users/search?q=$username&count=1&client_id=$this->clientId";

        $response = $this->client->get($url)->send();

        $data = json_decode($response->getBody());

        return $data->data[0]->id;
    }

    /**
     * find
     *
     * @param null $id
     * @param int $next
     * @return array
     */
    public function find($id = null, $next = 0)
    {
        $instID = $this->getInstagramID($id);
        $url = "/v1/users/$instID/media/recent/?count=$this->limit&client_id=$this->clientId";

        if($next != 0) $url .= "max_id=$next";

        $response = $this->client->get($url)->send();

        $data = json_decode($response->getBody());

        return array(
            'type' => 'instagram',
            'data' => $data
        );
    }

    /**
     * findByHash
     *
     * @param string $id
     *
     * @return array
     */
    public function findByHash($id)
    {
        $instID = $this->getInstagramID($id);
        $url = "/v1/media/$instID?client_id=$this->clientId";
        $response = $this->client->get($url)->send();

        $data = json_decode($response->getBody());

        return array(
            'type' => 'instagram',
            'data' => $data
        );
    }

    /**
     * createFeed
     *
     * @param string $hash
     * @param \WBB\BarBundle\Entity\Bar $bar
     *
     * @return Object
     */
    public function createObject($hash, Bar $bar = null)
    {
        $bar->addInstagramExcludedImg($hash);
        $this->em->persist($bar);
        $this->em->flush();

        return $bar;
    }

    /**
     * createFeed
     *
     * @param string $hash
     * @param \WBB\BarBundle\Entity\Bar $bar
     *
     * @return Object
     */
    public function removeObject($hash, Bar $bar = null)
    {
        $bar->removeInstagramExcludedImgs($hash);
        $this->em->persist($bar);
        $this->em->flush();

        return $bar->getInstagramExcludedImgs();
    }

    /**
     * listAll
     * @param \WBB\BarBundle\Entity\Bar $bar
     * @return array
     */
    public function listAll(Bar $bar){
        return $bar->getInstagramExcludedImgs();
    }
}
