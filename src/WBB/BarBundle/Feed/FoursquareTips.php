<?php

namespace WBB\BarBundle\Feed;

use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\FoursquareTips as FSEntity;

/**
 * Foursquare
 */
class FoursquareTips implements FeedInterface
{
    private $service;
    private $repository;
    private $limit;

    /**
     * __construct
     *
     * @param $service
     * @param $repository
     * @param $limit
     */
    public function __construct($service, $repository, $limit)
    {
        $this->service    = $service;
        $this->repository = $repository;
        $this->limit = $limit;
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
        $command = $client->getCommand('venues/tips', $params);
        $tips = $command->execute();

        return json_decode(array(
            'type' => 'fsTips',
            'data' => $tips['response']['tips']['items']
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

        $params = array( 'tip_id' => $id);

        $client = $this->container->get('jcroll_foursquare_client');
        $command = $client->getCommand('tips', $params);
        $tip = $command->execute();

        return json_decode(array(
            'data' => $tip['response']['tip']
        ));
    }

    /**
     * createFeed
     *
     * @param string $hash
     * @param \WBB\BarBundle\Entity\Bar $bar
     * @internal param \WBB\BarBundle\Feed\Thematic $thematic
     *
     * @return Feed
     */
    public function createFeed($hash, Bar $bar = null)
    {
        $tweet = $this->findByHash($hash);

        $feed = new Feed();
        $feed
            ->setHash($hash)
        ;

        return $feed;
    }

    /**
     * parseTwitter
     *
     * @param string $text
     *
     * @return string
     */
    private function parseTwitter($text)
    {
        //parse the tweet text into html
        $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a href="$1" target="_blank">$1</a>', $text);
        $text = preg_replace('/@(\w+)/', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $text);
        $text = preg_replace('/\s#(\w+)/', ' <a href="https://twitter.com/search?src=hash&q=%23$1" target="_blank">#$1</a>', $text);

        return $text;
    }
}
