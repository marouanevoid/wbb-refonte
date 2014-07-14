<?php

namespace WBB\CloudSearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{

    public function searchAction(Request $request)
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $results = $this->get('cloudsearch.searcher')->search(array(
            'q' => $request->query->get('q', null)
        ));

        return $this->render('WBBCloudSearchBundle:Search:search-results.html.twig', array(
                    'results' => $results
        ));
    }

}
