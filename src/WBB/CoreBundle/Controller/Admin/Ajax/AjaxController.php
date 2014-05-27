<?php

namespace WBB\CoreBundle\Controller\Admin\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    public function getSuburbsFromCityAction($cityId)
    {
        $html = "";
        $city = $this->getDoctrine()->getRepository('WBBCoreBundle:City')->find($cityId);

        $suburbs = $city->getSuburbs();

        foreach($suburbs as $suburb){
            $html .= '<option value="'.$suburb->getId().'" >'.$suburb->getName().'</option>';
        }

        return new JsonResponse($html);
    }
}
