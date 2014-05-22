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

    /**
     * find
     *
     * @param null $id
     * @param int $next
     * @return array
     */
    public function find($id = null, $next = 0)
    {
        $url = "/v1/users/$id/media/recent/?count=$this->limit&client_id=$this->clientId";

        if($next > 0) $url .= "max_id=$next";

        $response = $this->client->get($url)->send();

        $data = json_decode($response->getBody());

        return json_decode(array(
            'type' => 'instagram',
            'data' => $data
        ));
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

        $params = array( 'photo_id' => $id);

        $client = $this->container->get('jcroll_foursquare_client');
        $command = $client->getCommand('photos', $params);
        $tip = $command->execute();

        return json_decode(array(
            'data' => $tip['response']['photo']
        ));
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
        $bar->addFsSelectedImg($hash);
        $this->em->persist($bar);
        $this->em->flush();

        return $bar;
    }
}
