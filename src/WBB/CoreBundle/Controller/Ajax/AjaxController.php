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

    //Returns the list of cities in a country (add selected to the city passed in parameters)
    public function getCitiesFromCountryAction($bestof, $countryId, $cityId)
    {
        $html = "";
        $Object = null;
        if($bestof > 0){
            $Object = $this->getDoctrine()->getRepository('WBBBarBundle:BestOf')->find($bestof);
        }

        $country = $this->getDoctrine()->getRepository('WBBCoreBundle:Country')->find($countryId);

        $cities = $country->getCities();

        foreach($cities as $city){
            if($cityId > 0)
            {
                if($cityId == $city->getId())
                    $html .= '<option value="'.$city->getId().'" selected>'.$city->getName().'</option>';
                else
                    $html .= '<option value="'.$city->getId().'" >'.$city->getName().'</option>';
            }else{
                if($Object and $Object->getCity() and $Object->getCity()->getId() == $city->getId())
                    $html .= '<option value="'.$city->getId().'" selected>'.$city->getName().'</option>';
                else
                    $html .= '<option value="'.$city->getId().'" >'.$city->getName().'</option>';
            }
        }

        return new JsonResponse($html);
    }

    //Returns a list of bar medias (add selected to a media if passed on parameters)
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

    //Returns a list on Point of interest in a city (and a suburb)
    public function poiListAction($cityID = 0, $suburbID = 0)
    {
        if($cityID > 0)
        {
            $city = $this->container->get('city.repository')->findOneById($cityID);
            $suburb = $this->container->get('suburb.repository')->findOneById($suburbID);

            $bars = $this->container->get('bar.repository')->findAllEnabled($city, $suburb);
            $suburbs = $this->container->get('suburb.repository')->findByCity($city);
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

    //Returns a list of cities with one or more bars
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

    // Returns a list of filtred bars or bestofs (used also for "see more bars/bestofs")
    public function barGuideFilterAction($bars = 1, $city = 0, $filter = "popularity" , $offset = 0, $limit = 8)
    {
        $response = null;

        if($bars){
            if($filter === "popularity"){
                $response = $this->container->get('bar.repository')->findPopularBars($city, $limit, $offset);
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bar.repository')->findBarsOrderedByName($city, $offset ,$limit);
            }elseif($filter === "date"){
                $response = $this->container->get('bar.repository')->findLatestBars($city, $limit, $offset, false);
            }elseif($filter === "distance"){
                $response = $this->container->get('bar.repository')->findNearestBars(0, 0, $offset, $limit);
            }
        }else{
            if($filter === "popularity"){
                //TODO: Repository methode for popularity
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName($city, $offset ,$limit);
            }elseif($filter === "date"){
                $response = $this->container->get('bestof.repository')->findLatestBars($city, $limit, $offset, false);
            }
        }

        return new JsonResponse(array(
            'code' => '200',
            'response' => $response
        ));
    }

    // Methodes to parse objects
    private function arrayTagsToString($tags)
    {
        $result = "";

        foreach($tags as $tag)
        {
            $result .= $tag->getTag()->getName().', ';
        }

        return substr($result, 0, -2);
    }

    private function barFirstImage($bar)
    {
        $medias = $bar->getMedias();
        foreach($medias as $media)
        {
            if($media->getMedia()->getProviderName() === "sonata.media.provider.image")
                return $this->container->get("sonata.media.provider.image")->generatePublicUrl($media->getMedia(), 'slider_large');
        }

        return null;
    }
}
