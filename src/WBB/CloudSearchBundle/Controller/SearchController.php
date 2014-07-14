<?php

namespace WBB\CloudSearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class SearchController extends Controller
{

    public function searchAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            //return $this->redirect($this->generateUrl(('homepage')));
        }

        $results = $this->getSearchResults($request);

        return new JsonResponse($results);
    }

    public function searchResultsAction(Request $request)
    {
        $results = $this->getSearchResults($request);

        return $this->render('WBBCloudSearchBundle:Search:search-results.html.twig', array(
                    'results' => $results
        ));
    }

    private function getSearchResults(Request $request)
    {
        $q = $request->query->get('q', null);
        $size = $request->query->get('size', 10);
        $start = $request->query->get('start', 0);
        $entity = $request->query->get('entity', null);

        $results = $this->get('cloudsearch.searcher')->search(array(
            'q' => $q,
            'start' => $start,
            'size' => $size,
            'entity' => $entity
        ));

        $results['more_results'] = $this->generateUrl('wbb_cloudsearch_search', array(
            'q' => $q,
            'start' => $start + $size,
            'size' => $size,
            'entity' => $entity
        ));

        return $results;
    }

}
