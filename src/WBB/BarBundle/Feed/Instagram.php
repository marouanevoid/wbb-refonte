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

    protected $baseUrl = 'https://api.instagram.com/v1/';

    /**
     * __construct
     *
     * @param $container
     * @param $em
     * @param $limit
     */
    public function __construct($container, $em, $limit)
    {
        $this->container    = $container;
        $this->em           = $em;
        $this->limit        = $limit;
        $this->client       = new Client($this->baseUrl);
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
        $data = $this->client->get("users/$id/media/recent/?client_id=$this->container->getParameter('instagram_client_id')")->send()->getBody();

        var_dump($data);die;

        $params = array( 'venue_id' => $id, 'limit' => $this->limit);

        if($next > 0) $params['offset'] = $next;

        $client = $this->container->get('jcroll_foursquare_client');
        $command = $client->getCommand('venues/photos', $params);
        $tips = $command->execute();

        return json_decode(array(
            'type' => 'fsImg',
            'data' => $tips['response']['photos']['items']
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
