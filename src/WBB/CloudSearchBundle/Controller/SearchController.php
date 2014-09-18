<?php

namespace WBB\CloudSearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use WBB\BarBundle\Entity\Tag;
use WBB\CloudSearchBundle\Searcher\CloudSearchSearcher;

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
        $em = $this->getDoctrine()->getManager();

        $showAllBars = false;
        if ($request->get('_route') == 'wbb_search_all_bars') {
            $showAllBars = true;
        }

        $cities = $em->getRepository('WBBCoreBundle:City')->findCitiesOrderedByName();
        $types = Tag::getTypeNames();
        $tagsByType = array();
        $csNames = CloudSearchSearcher::getCSTagsNames();

        foreach ($types as $type => $name) {
            if (isset($csNames[$type])) {
                $tagsByType[] = array(
                    'name' => $name,
                    'csName' => $csNames[$type],
                    'tags' => $em->getRepository('WBBBarBundle:Tag')->findByType($type)
                );
            }
        }

        return $this->render('WBBCloudSearchBundle:Search:search-results.html.twig', array(
                    'tagsByType' => $tagsByType,
                    'cities' => $cities,
                    'showAllBars' => $showAllBars
        ));
    }

    private function getSearchResults(Request $request, $entity = 'Bar')
    {
        $q = $request->query->get('q', null);
        $tag = $request->query->get('tag', null);
        $size = $request->query->get('limit', 12);
        $start = $request->query->get('start', 0);
        $city = $request->query->get('city', null);
        $style = $request->query->get('style', null);
        $mood = $request->query->get('mood', null);
        $occasion = $request->query->get('occasion', null);
        $cocktails = $request->query->get('cocktails', null);
        $special = $request->query->get('special', null);
        $district = $request->query->get('district', null);
        $suggest = $request->query->get('suggest', false);

        if ($suggest) {
            $results = $this->get('cloudsearch.searcher')->suggest(array(
                'q' => $q,
                'size' => $size
            ));
        } else {
            $results = $this->get('cloudsearch.searcher')->search(array(
                'q' => $q,
                'tag' => $tag,
                'start' => $start,
                'size' => $size,
                'entity' => $entity,
                'city' => $city,
                'style' => $style,
                'mood' => $mood,
                'occasion' => $occasion,
                'cocktails' => $cocktails,
                'special' => $special,
                'district' => $district,
                'favorites' => true
            ));
        }

        return $results;
    }

}
