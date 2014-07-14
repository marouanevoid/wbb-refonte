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

        $entity = $request->query->get('entity', null);
        $results = $this->getSearchResults($request, $entity);

        return new JsonResponse($results);
    }

    public function searchResultsAction(Request $request)
    {
        $barResults = $this->getSearchResults($request, 'Bar');
        $newsResults = $this->getSearchResults($request, 'News');

        $cities = $this->getDoctrine()->getManager()->getRepository('WBBCoreBundle:City')->findAll();

        return $this->render('WBBCloudSearchBundle:Search:search-results.html.twig', array(
                    'bar_results' => $barResults,
                    'news_results' => $newsResults,
                    'cities' => $cities
        ));
    }

    private function getSearchResults(Request $request, $entity = 'Bar')
    {
        $q = $request->query->get('q', null);
        $size = $request->query->get('size', 12);
        $start = $request->query->get('start', 0);
        $city = $request->query->get('city', null);

        $results = $this->get('cloudsearch.searcher')->search(array(
            'q' => $q,
            'start' => $start,
            'size' => $size,
            'entity' => $entity,
            'city' => $city
        ));

        $results['more_results'] = $this->generateUrl('wbb_cloudsearch_search', array(
            'q' => $q,
            'start' => $start + $size,
            'size' => $size,
            'entity' => $entity,
            'city' => $city
        ));

        return $results;
    }

}
