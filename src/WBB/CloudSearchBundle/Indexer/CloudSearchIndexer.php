<?php

namespace WBB\CloudSearchBundle\Indexer;

use Aws\CloudSearchDomain\CloudSearchDomainClient;

class CloudSearchIndexer implements IndexerInterface
{

    private $container;
    private $cloudSearchClient;

    public function __construct($container, $parameters)
    {
        $this->container = $container;
        $this->cloudSearchClient = CloudSearchDomainClient::factory(array(
                    'base_url' => 'http://doc-' . $parameters[0] . '-' . $parameters[1] . '.' . $parameters[2] . '.cloudsearch.amazonaws.com/2013-01-01',
                    'key' => $parameters[3],
                    'secret' => $parameters[4]
        ));
    }

    public function index(IndexableEntity $entity)
    {
        $request = $this->cloudSearchClient->post('documents/batch');
        $request->setHeader('content-type', 'application/json');

        $id = $this->generateEntityId($entity);
        $body = array(array(
                'type' => 'add',
                'id' => $id,
                'fields' => $entity->getCloudSearchFields()
        ));

        if ($this->getEntityType($entity) == 'BestOf') {
            $image = $entity->getImage();
            if ($image) {
                $body[0]['fields']['wbb_media_url'] = $this->getMediaPublicUrl($image, 'simple_image_big');
            }
        } elseif ($this->getEntityType($entity) == 'Bar') {
            $medias = $entity->getMedias();
            if (isset($medias[0])) {
                $body[0]['fields']['wbb_media_url'] = $this->getMediaPublicUrl($medias[0], 'simple_image_big');
            }
        }

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

        $request->setBody(json_encode($body));
        $request->send()->json();
    }

    private function getMediaPublicUrl($media, $format)
    {
        $provider = $this->container->get($media->getProviderName());

        return $provider->generatePublicUrl($media, $format);
    }

    private function getEntityType($entity)
    {
        $fqcn = get_class($entity);
        $parts = explode('\\', $fqcn);

        return $parts[count($parts) - 1];
    }

    private function generateEntityId($entity)
    {
        return $this->getEntityType($entity) . '_' . $entity->getId();
    }

}
