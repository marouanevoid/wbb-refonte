<?php

namespace WBB\CloudSearchBundle\Searcher;

use Aws\CloudSearchDomain\CloudSearchDomainClient;
use WBB\BarBundle\Entity\Tag;

class CloudSearchSearcher
{

    private $cloudSearchClient;
    private $container;
    private $suggestFields = array(
        "'name^50'",
        "'title^50'",
        "'bestofs'",
        "'bars'",
        "'slug'",
        "'address'",
        "'cities'",
        "'city'",
        "'country'",
        "'description'",
        "'district'",
        "'districts'",
        "'location'",
        "'quote'",
        "'quote_author'",
        "'seo_description'",
        "'tags_cocktails'",
        "'tags_food'",
        "'tags_mood'",
        "'tags_occasion'",
        "'tags_special'",
        "'tags_style'",
        "'text'",
        "'website'"
    );

    public static function getCSTagsNames()
    {
        return array(
            Tag::WBB_TAG_TYPE_BEST_COCKTAILS => 'cocktails',
            Tag::WBB_TAG_TYPE_ENERGY_LEVEL => 'mood',
            Tag::WBB_TAG_TYPE_WITH_WHO => 'occasion',
            Tag::WBB_TAG_TYPE_THEME => 'style',
            Tag::WBB_TAG_TYPE_SPECIAL_FEATURES => 'special'
        );
    }

    public function __construct($container, $parameters)
    {
        $this->container = $container;
        $this->cloudSearchClient = CloudSearchDomainClient::factory(array(
                    'base_url' => 'http://search-' . $parameters[0] . '-' . $parameters[1] . '.' . $parameters[2] . '.cloudsearch.amazonaws.com/2013-01-01',
                    'key' => $parameters[3],
                    'secret' => $parameters[4]
        ));
    }

    public function suggest(array $parameters)
    {
        $request = $this->cloudSearchClient->get('search');
        $query = $request->getQuery();

        $q = "{$parameters['q']}* {$parameters['q']}";

        $query->set('q', $q);
        $query->set('q.options', "{defaultOperator: 'or', fields: [" . implode(',', $this->suggestFields) . "]}");
        $query->set('size', 10000);

        $response = $request->send()->json();

        $cities = $this->getEntityResults($response['hits']['hit'], 'City');
        $bestOfs = $this->getEntityResults($response['hits']['hit'], 'BestOf');
        $news = $this->getEntityResults($response['hits']['hit'], 'News');
        $bars = $this->getEntityResults($response['hits']['hit'], 'Bar');

        $results = array_merge($cities, $bestOfs, $news, $bars);
        $response['hits']['hit'] = array_slice($results, 0, $parameters['size']);

        return $response;
    }

    public function findAll()
    {
        $parameters = array(
            'q' => '-thisconnotbefoundincloudsearchever',
            'start' => 0,
            'size' => 10000,
            'entity' => null,
            'city' => null,
            'style' => null,
            'mood' => null,
            'occasion' => null,
            'cocktails' => null,
            'special' => null,
            'district' => null,
            'favorites' => false
        );

        return $this->doSearch($parameters);
    }

    public function search(array $parameters)
    {
        $response = $this->doSearch($parameters);

        if ($parameters['favorites']) {
            $response = $this->favorites($response);
        }

        $parameters['entity'] = 'Bar';
        $barResponse = $this->doSearch($parameters);
        $parameters['entity'] = 'News';
        $newsResponse = $this->doSearch($parameters);

        $response['hits']['bars'] = $barResponse['hits']['found'];
        $response['hits']['news'] = $newsResponse['hits']['found'];

        return $response;
    }

    private function getEntityResults($results, $entity)
    {
        $response = array();
        foreach ($results as $result) {
            if ($result['fields']['entity_type'] == $entity) {
                $response[] = $result;
            }
        }

        return $response;
    }

    private function favorites($response)
    {
        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $ext = $this->container->get('wbb.twig.favorite_extension');
            $user = $this->container->get('security.context')->getToken()->getUser();

            $c = 0;
            foreach ($response['hits']['hit'] as $bar) {
                if (isset($bar['fields']['entity_type']) && $bar['fields']['entity_type'] === 'Bar') {
                    $dbBar = $this->container->get('bar.repository')->find($bar['fields']['wbb_id']);
                    if ($dbBar) {
                        $bar['fields']['favorite'] = $ext->isFavorite($user, $dbBar);
                        $bar['fields']['favorite_url'] = $ext->getFavoriteUrl($user, $dbBar);
                    } else {
                        $bar['fields']['favorite'] = false;
                        $bar['fields']['favorite_url'] = '#';
                    }

                    $response['hits']['hit'][$c] = $bar;
                }
                $c++;
            }
        }

        return $response;
    }

    private function doSearch(array $parameters)
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
            'occasion',
            'special'
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

        if ($q == '(and \'-thisconnotbefoundincloudsearchever*\' )') {
            $q = '(and -thisconnotbefoundincloudsearchever )';
        } else {
            $query->set('q.parser', 'structured');
        }
        $query->set('size', $parameters['size']);
        $query->set('start', $parameters['start']);
        $query->set('q', $q);

        $response = $request->send()->json();

        return $response;
    }

}
