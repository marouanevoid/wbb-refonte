<?php

namespace WBB\CoreBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    //Returns the list of suburbs in a city (add selected to the suburbs passed in parameters)
    public function getSuburbsFromCityAction($bar, $cityId, $suburbId)
    {
        $html = "";
        $barObject = null;
        if ($bar > 0) {
            $barObject = $this->getDoctrine()->getRepository('WBBBarBundle:Bar')->find($bar);
        }

        $city = $this->getDoctrine()->getRepository('WBBCoreBundle:City')->find($cityId);

        $suburbs = $city->getSuburbs();

        foreach ($suburbs as $suburb) {
            if ($suburbId > 0) {
                if($suburbId == $suburb->getId())
                    $html .= '<option value="'.$suburb->getId().'" selected>'.$suburb->getName().'</option>';
                else
                    $html .= '<option value="'.$suburb->getId().'" >'.$suburb->getName().'</option>';
            } else {
                if($barObject && $barObject->getSuburb() && $barObject->getSuburb()->getId() == $suburb->getId())
                    $html .= '<option value="'.$suburb->getId().'" selected>'.$suburb->getName().'</option>';
                else
                    $html .= '<option value="'.$suburb->getId().'" >'.$suburb->getName().'</option>';
            }
        }

        return new JsonResponse($html);
    }

    //Returns the list of cities in a country (add selected to the city passed in parameters)
    public function getCitiesFromCountryAction($bestof, $countryId, $cityId)
    {
        $html = "";
        $Object = null;
        if ($bestof > 0) {
            $Object = $this->getDoctrine()->getRepository('WBBBarBundle:BestOf')->find($bestof);
        }

        $country = $this->getDoctrine()->getRepository('WBBCoreBundle:Country')->find($countryId);

        $cities = $country->getCities();

        foreach ($cities as $city) {
            if ($cityId > 0) {
                if($cityId == $city->getId())
                    $html .= '<option value="'.$city->getId().'" selected>'.$city->getName().'</option>';
                else
                    $html .= '<option value="'.$city->getId().'" >'.$city->getName().'</option>';
            } else {
                if($Object && $Object->getCity() && $Object->getCity()->getId() == $city->getId())
                    $html .= '<option value="'.$city->getId().'" selected>'.$city->getName().'</option>';
                else
                    $html .= '<option value="'.$city->getId().'" >'.$city->getName().'</option>';
            }
        }

        return new JsonResponse($html);
    }

    //Returns a list of bar medias (add selected to a media if passed on parameters)
    public function getMediasFromBarAction($barID, $mediaID)
    {
        $html = "";
        $bar = null;
        if ($barID > 0) {
            $bar = $this->getDoctrine()->getRepository('WBBBarBundle:Bar')->find($barID);
        } else {
            return new JsonResponse(array());
        }

        $medias = $bar->getMedias();
        $i = 1;
        foreach ($medias as $media) {
            if($mediaID == $media->getId())
                $html .= '<option value="'.$media->getId().'" selected>'.$i.': '.$media->getAlt().'</option>';
            else
                $html .= '<option value="'.$media->getId().'" >'.$i.': '.$media->getAlt().'</option>';

            $i++;
        }

        return new JsonResponse($html);
    }
}
