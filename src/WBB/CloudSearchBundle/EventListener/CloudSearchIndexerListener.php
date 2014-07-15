<?php

namespace WBB\CloudSearchBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use WBB\CloudSearchBundle\Indexer\IndexerInterface;
use WBB\CloudSearchBundle\Indexer\IndexableEntity;
use WBB\BarBundle\Entity\Bar;

class CloudSearchIndexerListener
{

    private $indexer;

    public function __construct(IndexerInterface $indexer)
    {
        $this->indexer = $indexer;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof IndexableEntity) {
            $this->indexer->delete($entity);
        }
    }

    private function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if ($entity instanceof IndexableEntity) {
            if ($entity instanceof Bar) {
                if ($entity->getStatus() == Bar::BAR_STATUS_ENABLED_VALUE) {
                    $this->indexer->index($entity);
                }
            } else {
                $this->indexer->index($entity);
            }
        }
    }

}
