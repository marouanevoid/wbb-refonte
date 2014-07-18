<?php

namespace WBB\CloudSearchBundle\Indexer;

interface IndexerInterface
{

    /**
     * Indexes the given entity in the CloudSearch server.
     *
     * @param \WBB\CloudSearchBundle\Indexer\IndexableEntity $entity
     */
    public function index(IndexableEntity $entity);

    /**
     * Deletes the given entity from the CloudSearch server.
     *
     * @param \WBB\CloudSearchBundle\Indexer\IndexableEntity $entity
     */
    public function delete(IndexableEntity $entity);
}
