<?php

namespace WBB\CoreBundle\Controller\Admin\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    public function getSuburbsFromCityAction($bar, $cityId)
    {
        $html = "";
        $bar = null;
        if($bar > 0){
            $bar = $this->getDoctrine()->getRepository('WBBBarBundle:Bar')->find($bar);
        }

        $city = $this->getDoctrine()->getRepository('WBBCoreBundle:City')->find($cityId);

        $suburbs = $city->getSuburbs();

        foreach($suburbs as $suburb){
            if($bar and $bar->getSuburb() and $bar->getSuburb()->getId() == $suburb->getId())
                $html .= '<option value="'.$suburb->getId().'" selected>'.$suburb->getName().'</option>';
            else
                $html .= '<option value="'.$suburb->getId().'" >'.$suburb->getName().'</option>';
        }

        return new JsonResponse($html);
    }

//    public function getSuburbsFromCityAction($bar, $cityId)
//    {
//        $html = "";
//        $bar = null;
//        if($bar > 0){
//            $bar = $this->getDoctrine()->getRepository('WBBBarBundle:Bar')->find($bar);
//        }
//
//        $city = $this->getDoctrine()->getRepository('WBBCoreBundle:City')->find($cityId);
//
//        $suburbs = $city->getSuburbs();
//
//        $response = array("more" => false);
//
//        foreach($suburbs as $suburb){
//            $response[] = array('id' => $suburb->getId(), 'text' => '"'.$suburb->getName().'"');
//        }
//
//        return new JsonResponse( array("results" => $response));
//    }
}
