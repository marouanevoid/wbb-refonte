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

        $query->set('q', $parameters['q']);

        $response = $request->send()->json();
        return $response;
    }

}
