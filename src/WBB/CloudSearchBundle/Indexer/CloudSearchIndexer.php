<?php

namespace WBB\CloudSearchBundle\Indexer;

use Aws\CloudSearchDomain\CloudSearchDomainClient;

class CloudSearchIndexer implements IndexerInterface
{

    private $container;
    private $logger;
    private $router;
    private $cloudSearchClient;

    public function __construct($container, $parameters)
    {
        $this->container = $container;
        $this->logger = $this->container->get('logger');
        $this->router = $container->get('router');
        $this->cloudSearchClient = CloudSearchDomainClient::factory(array(
            'base_url' => 'http://doc-' . $parameters[0] . '-' . $parameters[1] . '.' . $parameters[2] . '.cloudsearch.amazonaws.com/2013-01-01',
            'key' => $parameters[3],
            'secret' => $parameters[4]
        ));
    }

    public function index(IndexableEntity $entity)
    {
        if ($entity instanceof \WBB\CoreBundle\Entity\City) {
            if (!$entity->getOnTopCity() && $entity->getBars()->count() == 0) {
                $this->logger->info('[CloudSearch][Indexer] : City not on top and does not have bars : ' . $entity->getName());

                return;
            }
        }
        $request = $this->cloudSearchClient->post('documents/batch');
        $request->setHeader('content-type', 'application/json');

        $id = $this->generateEntityId($entity);
        $body = array(array(
            'type' => 'add',
            'id' => $id,
            'fields' => $entity->getCloudSearchFields()
        ));

        $body[0]['fields']['entity_type'] = $this->getEntityType($entity);
        $body[0]['fields']['url'] = $this->getUrlForEntity($entity);

        if ($this->getEntityType($entity) == 'News') {
            $medias = $entity->getMedias();
            foreach ($medias as $media) {
                if ($media->getPosition() == 1) {
                    $this->logger->info('[CloudSearch][Indexer] : Image found for a News entity : ' . $entity->getTitle());
                    $body[0]['fields']['wbb_media_url'] = $this->getMediaPublicUrl($media->getMedia(), 'news_286_210');
                }
            }
        } elseif ($this->getEntityType($entity) == 'Bar') {
            $medias = $entity->getMedias();
            foreach ($medias as $media) {
                if ($media->getPosition() == 1) {
                    $this->logger->info('[CloudSearch][Indexer] : Image found for a Bar entity : ' . $entity->getName());
                    $body[0]['fields']['wbb_media_url'] = $this->getMediaPublicUrl($media->getMedia(), 'bar_286_210');
                }
            }
        }

        $this->logger->info('[CloudSearch][Indexer] : Trying to index the entity : ' . $body[0]['id']);

        $request->setBody(json_encode($body));
        $request->send()->json();
    }

    public function deleteById($id)
    {
        $request = $this->cloudSearchClient->post('documents/batch');
        $request->setHeader('content-type', 'application/json');

        $body = array(array(
            'type' => 'delete',
            'id' => $id
        ));

        $this->logger->info('[CloudSearch][Indexer] : Trying to deleteById the entity : ' . $id);

        $request->setBody(json_encode($body));
        $request->send()->json();
    }

    public function delete(IndexableEntity $entity)
    {
        $request = $this->cloudSearchClient->post('documents/batch');
        $request->setHeader('content-type', 'application/json');

        $id = $this->generateEntityId($entity);
        $body = array(array(
            'type' => 'delete',
            'id' => $id
        ));

        $this->logger->info('[CloudSearch][Indexer] : Trying to delete the entity : ' . $id);

        $request->setBody(json_encode($body));
        $request->send()->json();
    }

    private function getMediaPublicUrl($media, $format)
    {
        $imagineService = $this->container->get('liip_imagine.cache.manager');

        $parsed = parse_url($imagineService->getBrowserPath($media, $format));
        if (isset($parsed['path'])) {
            return $parsed['path'];
        }

        return null;
    }

    private function getEntityType($entity)
    {
        $fqcn = get_class($entity);
        $parts = explode('\\', $fqcn);

        return $parts[count($parts) - 1];
    }

    private function getUrlForEntity($entity)
    {
        if ($entity instanceof \WBB\BarBundle\Entity\Bar) {
            return $this->router->generate('wbb_bar_details', array(
                'city' => $entity->getCity()->getSlug(),
                'suburb' => $entity->getSuburb()->getSlug(),
                'slug' => $entity->getSlug()
            ));
        } elseif ($entity instanceof \WBB\BarBundle\Entity\News) {
            return $this->router->generate('wbb_news_details_page', array(
                'newsSlug' => $entity->getSlug()
            ));
        } elseif ($entity instanceof \WBB\CoreBundle\Entity\City) {
            if ($entity->getOnTopCity()) {
                return $this->router->generate('city_homepage', array(
                    'slug' => $entity->getSlug()
                ));
            } else {
                return $this->router->generate('wbb_cities_city', array(
                    'slug' => $entity->getSlug(),
                    'suburb' => null
                ));
            }
        } elseif ($entity instanceof \WBB\BarBundle\Entity\BestOf) {
            return $this->router->generate('wbb_bar_bestof_global', array(
                'bestOfSlug' => $entity->getSlug()
            ));
        }
    }

    private function generateEntityId($entity)
    {
        return $this->getEntityType($entity) . '_' . $entity->getId();
    }

}
