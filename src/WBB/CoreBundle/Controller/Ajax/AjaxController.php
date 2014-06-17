<?php

namespace WBB\CoreBundle\Controller\Ajax;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    public function getSuburbsFromCityAction($bar, $cityId, $suburbId)
    {
        $html = "";
        $barObject = null;
        if($bar > 0){
            $barObject = $this->getDoctrine()->getRepository('WBBBarBundle:Bar')->find($bar);
        }

        $city = $this->getDoctrine()->getRepository('WBBCoreBundle:City')->find($cityId);

        $suburbs = $city->getSuburbs();

        foreach($suburbs as $suburb){
            if($suburbId > 0)
            {
                if($suburbId == $suburb->getId())
                    $html .= '<option value="'.$suburb->getId().'" selected>'.$suburb->getName().'</option>';
                else
                    $html .= '<option value="'.$suburb->getId().'" >'.$suburb->getName().'</option>';
            }else{
                if($barObject and $barObject->getSuburb() and $barObject->getSuburb()->getId() == $suburb->getId())
                    $html .= '<option value="'.$suburb->getId().'" selected>'.$suburb->getName().'</option>';
                else
                    $html .= '<option value="'.$suburb->getId().'" >'.$suburb->getName().'</option>';
            }
        }

        return new JsonResponse($html);
    }

    public function getBarMedias($barID, $mediaID)
    {
        $html = "";
        $bar = null;
        if($barID > 0){
            $bar = $this->getDoctrine()->getRepository('WBBBarBundle:Bar')->find($barID);
        }else{
            return new JsonResponse(array());
        }

        $medias = $bar->getMedias();

        foreach($medias as $media){
            if($mediaID == $media->getId())
                $html .= '<option value="'.$media->getId().'" selected>'.$media->getAlt().'</option>';
            else
                $html .= '<option value="'.$media->getId().'" >'.$media->getAlt().'</option>';
        }

        return new JsonResponse($html);
    }

    public function poiListAction($cityID, $suburbID=0)
    {
        if($cityID> 0)
        {
            $city = $this->container->get('city.repository')->findOneById($cityID);
            if($suburbID > 0)
                $suburb = $this->container->get('suburb.repository')->findOneById($suburbID);

            if($suburbID > 0)
                $bars = $this->container->get('bar.repository')->findAllEnabled($city, $suburb);
            else
                $bars = $this->container->get('bar.repository')->findAllEnabled($city);

            $suburbs = $this->container->get('suburb.repository')->findAll();
            $result = array('bars' => array(), 'suburbs' => array());

            foreach($bars as $bar)
            {
                $result['bars'][] = array(
                    'id'        => $bar->getId(),
                    'address'   => $bar->getAddress(),
                    'name'      => $bar->getName(),
                    'url'       => $this->container->get('router')->generate('wbb_bar_details', array(
                            'slug'      => $bar->getSlug(),
                            'suburb'    => $bar->getSuburb()->getSlug(),
                            'city'      => $bar->getCity()->getSlug()
                        )),
                    'image_url' => $this->barFirstImage($bar),
                    'tags'      => $this->arrayTagsToString($bar->getTags()),
                    'latitude'  => $bar->getLatitude(),
                    'longitude' => $bar->getLongitude()
                );
            }

            foreach($suburbs as $suburb)
            {
                $result['suburbs'][] = array(
                    'id'    => $suburb->getId(),
                    'name'  => $suburb->getName()
                );
            }

            return new JsonResponse(array(
                'code'          => 200,
                'bars'          => $result['bars'],
                'neighborhoods' => $result['suburbs']
            ));
        }else{
            return new JsonResponse(array(
                'code'      => 500,
                'message'   => 'City or Suburb not valide.'
            ));
        }
    }

    public function citiesListAction()
    {
        $cities = $this->container->get('city.repository')->findCitiesWithBars();

        $response = array();

        foreach($cities as $city)
        {
            $response[] = array(
                'id'        => $city->getId(),
                'name'      => $city->getName() .', '. $city->getCountry(),
                'latitude'  => $city->getLatitude(),
                'longitude' => $city->getLongitude()
            );
        }

        return new JsonResponse(array(
            'code'   => 200,
            'cities' => $response
        ));
    }
}
