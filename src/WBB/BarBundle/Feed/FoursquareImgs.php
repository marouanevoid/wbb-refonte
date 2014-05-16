<?php

namespace WBB\BarBundle\Feed;

use WBB\BarBundle\Entity\Bar;

/**
 * Foursquare
 */
class FoursquareImgs implements FeedInterface
{
    private $container;
    private $em;
    private $limit;

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
        $params = array( 'venue_id' => $id, 'limit' => $this->limit);

        if($next > 0) $params['offset'] = $next;

        $client = $this->container->get('jcroll_foursquare_client');
        $command = $client->getCommand('venues/photos', $params);
        $tips = $command->execute();

        return array(
            'type' => 'fsImgs',
            'data' => $tips['response']['photos']['items']
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

        $params = array( 'photo_id' => $id);

        $client = $this->container->get('jcroll_foursquare_client');
        $command = $client->getCommand('photos', $params);
        $tip = $command->execute();

        return array(
            'data' => $tip['response']['photo']
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
        $bar->addFsSelectedImg($hash);
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
        $bar->removeFsSelectedImgs($hash);
        $this->em->persist($bar);
        $this->em->flush();

        return $bar->getFsSelectedImgs();
    }
}
