<?php

namespace WBB\BarBundle\Feed;

use WBB\BarBundle\Entity\FoursquareTips as FSEntity;

/**
 * Foursquare
 */
class FoursquareTips implements FeedInterface
{
    private $service;
    private $repository;

    /**
     * __construct
     *
     * @param $service
     * @param $repository
     */
    public function __construct($service, $repository)
    {
        $this->service    = $service;
        $this->repository = $repository;
    }

    /**
     * find
     *
     * @param null $id
     * @return array
     */
    public function find($id = null)
    {
        $client = $this->container->get('jcroll_foursquare_client');
        $command = $client->getCommand('venues', array('venue_id' => $id));
        $tips = $command->execute();

        return array(
            'type' => 'fsTips',
            'data' => $tips
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
        $response = $this->twitter->query('statuses/show', 'GET', 'json', array('id' => $id));

        return json_decode($response->getContent());
    }

    /**
     * createFeed
     *
     * @param string   $hash
     * @param Thematic $thematic
     *
     * @return Feed
     */
    public function createFeed($hash, Thematic $thematic = null)
    {
        $tweet = $this->findByHash($hash);

        $feed = new Feed();
        $feed
            ->setHash($hash)
            ->setContent($this->parseTwitter($tweet->text))
            ->setEnabled(true)
            ->setPostedAt(new \DateTime($tweet->created_at))
            ->setUserLogin($tweet->user->screen_name)
            ->setUsername($tweet->user->name)
            ->setSource(Feed::SOURCE_TWITTER)
            ->setUserPhoto($tweet->user->profile_image_url)
            ->setThematic($thematic)
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
