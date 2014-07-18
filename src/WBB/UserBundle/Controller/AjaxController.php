<?php

namespace WBB\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AjaxController extends Controller
{

    public function citiesAction(Request $request)
    {
        $cityName = $request->query->get('name', null);
        $cities = $this->getDoctrine()
                ->getManager()
                ->getRepository('WBBCoreBundle:City')
                ->findCitiesLike($cityName);

        $citiesNames = array();
        foreach ($cities as $city) {
            $citiesNames[] = array('name' => $city->getName());
        }

        return new JsonResponse($citiesNames);
    }

}
