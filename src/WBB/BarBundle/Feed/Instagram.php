<?php

namespace WBB\BarBundle\Feed;

use WBB\BarBundle\Entity\Bar;
use Guzzle\Http\Client;

/**
 * Foursquare
 */
class Instagram implements FeedInterface
{
    private $em;
    private $limit;
    private $client;
    private $clientId;

    protected $baseUrl = "https://api.instagram.com";

    /**
     * __construct
     *
     * @param $em
     * @param $limit
     * @param $clientId
     */
    public function __construct($em, $limit, $clientId)
    {
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
     * @param  null  $id
     * @param  int   $next
     * @return array
     */
    public function find($id = null, $next = 0)
    {
        $instID = $this->getInstagramID($id);
        $url = "/v1/users/$instID/media/recent/?count=$this->limit&client_id=$this->clientId";

        if($next != 0) $url .= '&max_id='.$next;

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
     * @param string                    $hash
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
     * @param string                    $hash
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
     * @param  \WBB\BarBundle\Entity\Bar $bar
     * @return array
     */
    public function listAll(Bar $bar)
    {
        return $bar->getInstagramExcludedImgs();
    }

    /**
     * showList
     * @param  \WBB\BarBundle\Entity\Bar $bar
     * @param $offset
     * @param int $limit
     * @return array
     */
    public function showList(Bar $bar, $offset, $limit = 5)
    {
        $excluded = $bar->getInstagramExcludedImgs();

        $imgs = array();
        $index = 0;
        $next = 0;
        $recursive = 0;

        do {
            $instaImgsList = $this->find($bar->getInstagram(), $next);
//            var_dump($instaImgsList['data']->data);die;

            foreach($instaImgsList['data']->data as $img){
                if(!in_array($img->id, $excluded)){
                    $imgs[] = $img;
                    $index++;
                }
                $next = $img->id;
            }

            $recursive++;
        } while (($index < $limit) && $recursive < 5);

        return $imgs;
    }
}
