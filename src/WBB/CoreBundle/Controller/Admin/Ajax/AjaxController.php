<?php

namespace WBB\CoreBundle\Controller\Admin\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    public function getSuburbsFromCityAction($bar, $cityId)
    {
        $html = "";
        $bar = $this->getDoctrine()->getRepository('WBBBarBundle:Bar')->find($bar);
        $city = $this->getDoctrine()->getRepository('WBBCoreBundle:City')->find($cityId);

        $suburbs = $city->getSuburbs();

        foreach($suburbs as $suburb){
            if($bar->getSuburb()->getId() == $suburb->getId())
                $html .= '<option value="'.$suburb->getId().'" selected>'.$suburb->getName().'</option>';
            else
                $html .= '<option value="'.$suburb->getId().'" >'.$suburb->getName().'</option>';
        }

        return new JsonResponse($html);
    }
}
