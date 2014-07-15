<?php

namespace WBB\CloudSearchBundle\Searcher;

use Aws\CloudSearchDomain\CloudSearchDomainClient;

class CloudSearchSearcher
{

    private $cloudSearchClient;

    public function __construct($parameters)
    {
        $this->cloudSearchClient = CloudSearchDomainClient::factory(array(
                    'base_url' => 'http://search-' . $parameters[0] . '-' . $parameters[1] . '.' . $parameters[2] . '.cloudsearch.amazonaws.com/2013-01-01',
                    'key' => $parameters[3],
                    'secret' => $parameters[4]
        ));
    }

    public function search(array $parameters)
    {
        $request = $this->cloudSearchClient->get('search');
        $query = $request->getQuery();

        $q = "(and '{$parameters['q']}*' ";
        if ($parameters['entity']) {
            $q = $q . "entity_type:'{$parameters['entity']}'";
        }
        if ($parameters['city']) {
            $q = $q . " city:'{$parameters['city']}'";
        }
        $tagsTypes = array(
            'style',
            'mood',
            'cocktails',
            'occasion'
        );

        foreach ($tagsTypes as $tagType) {
            if ($parameters[$tagType]) {
                $tags = explode(',', $parameters[$tagType]);
                foreach ($tags as $tag) {
                    $q = $q . " tags_$tagType:'$tag'";
                }
            }
        }

        $q = $q . ")";

        $query->set('q', $q);
        $query->set('q.parser', 'structured');
        $query->set('size', $parameters['size']);
        $query->set('start', $parameters['start']);

        $response = $request->send()->json();

        return $response;
    }

}
