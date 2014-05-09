<?php

namespace WBB\BarBundle\Feed;

use WBB\BarBundle\Entity\Bar;

interface FeedInterface
{
    /**
     * find
     *
     * @param null $id
     * @param int $next
     * @return array
     */
    public function find($id = null, $next = 0);

    /**
     * findByHash
     *
     * @param string $id
     *
     * @return array
     */
    public function findByHash($id);

    /**
     * createFeed
     *
     * @param string   $hash
     * @param Bar $bar
     *
     * @return Feed
     */
    public function createFeed($hash, Bar $bar = null);
}
