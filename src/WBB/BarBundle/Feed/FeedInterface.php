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
     * createObject
     *
     * @param string   $hash
     * @param Bar $bar
     *
     * @return Object
     */
    public function createObject($hash, Bar $bar = null);
    
    /**
     * removeObject
     *
     * @param string   $hash
     * @param Bar $bar
     *
     * @return Object
     */
    public function removeObject($hash, Bar $bar = null);
}
