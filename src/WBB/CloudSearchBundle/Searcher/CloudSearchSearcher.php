<?php

namespace WBB\CloudSearchBundle\Searcher;

use Aws\CloudSearchDomain\CloudSearchDomainClient;
use WBB\BarBundle\Entity\Tag;

class CloudSearchSearcher
{

    private $cloudSearchClient;

    public static function getCSTagsNames()
    {
        return array(
            Tag::WBB_TAG_TYPE_BEST_COCKTAILS => 'cocktails',
            Tag::WBB_TAG_TYPE_ENERGY_LEVEL => 'mood',
            Tag::WBB_TAG_TYPE_WITH_WHO => 'occasion',
            Tag::WBB_TAG_TYPE_THEME => 'style'
        );
    }

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
            if ($parameters['entity'] == 'News') {
                $q = $q . " cities:'{$parameters['city']}'";
            } else {
                $q = $q . " city:'{$parameters['city']}'";
            }
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
        if ($parameters['district']) {
            $or = '';
            foreach (explode(',', $parameters['district']) as $district) {
                $or = $or . " district:'$district'";
            }
            $q = $q . " (or $or)";
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
