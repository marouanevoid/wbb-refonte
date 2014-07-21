<?php

namespace WBB\CloudSearchBundle\Indexer;

interface IndexableEntity
{

    /**
     * Returns a list of SearchCloud fields with there values.
     *
     * @return array
     */
    public function getCloudSearchFields();
}
