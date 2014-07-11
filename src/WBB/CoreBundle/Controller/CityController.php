<?php

namespace WBB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CityController
 */
class CityController extends Controller
{
    public function citiesAction()
    {
        return $this->render('WBBCoreBundle:City:cities.html.twig');
    }

    //Returns a list of cities with one or more bars
    public function citiesListAction($keywords = "")
    {
        $cities = $this->container->get('city.repository')->findCitiesWithBars($keywords);

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

    public function nearestCityAction($latitude, $longitude)
    {
        $session = $this->container->get('session');

        $city = $this->get('city.repository')->findNearestCity($latitude, $longitude, 150, 0, 1);

        $session->set('userLatitude', $latitude);
        $session->set('userLongitude', $longitude);
//        $session->set('fromGeo', true);
        $session->set('citySlug', $city->getSlug());

        if($city){
            return new JsonResponse(array(
                'id'    => $city->getId(),
                'name'  => $city->getName(),
                'slug'  => $city->getSlug(),
                'latitude' => $city->getLatitude(),
                'longitude' => $city->getLongitude()
            ));
        }
        else{
            return new JsonResponse(array(
                'message' => 'No near city found!'
            ));
        }

    }

    //Returns a list on Point of interest in a city (and a suburb)
    public function barsListAction($cityID = 0, $suburbID = 0, Request $request)
    {
        if($suburbID=='undefined')
            $suburbID=0;
        if($cityID > 0)
        {
            $city = $this->container->get('city.repository')->findOneById($cityID);
            $suburb = $this->container->get('suburb.repository')->findOneById($suburbID);

            $bars = $this->container->get('bar.repository')->findAllEnabled($city, $suburb);
            $suburbs = $this->container->get('suburb.repository')->findByCityWithBars($city);
            $result = array('bars' => array(), 'suburbs' => array());

            foreach($bars as $bar)
            {
                $address = $city->getName();

                $suburbBar = $bar->getSuburb();
                if (!empty($suburbBar))
                  $address = $suburbBar->getName().", ".$city->getName();

                $addressBar = $bar->getAddress();
                if (!empty($addressBar) && empty($suburbBar))
                    $address = $addressBar.", ".$city->getName();

                if (!empty($addressBar))
                    $address = $addressBar.", ".$suburbBar->getName().", ".$city->getName();

                $result['bars'][] = array(
                    'id'        => $bar->getId(),
                    'address'   => $address,
                    'name'      => $bar->getName(),
                    'url'       => $this->container->get('router')->generate('wbb_bar_details', array(
                            'slug'      => $bar->getSlug(),
                            'suburb'    => $bar->getSuburb()->getSlug(),
                            'city'      => $bar->getCity()->getSlug()
                        )),
                    'image_url' => $this->barFirstImage($bar, $request),
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

    // Methodes to parse objects
    private function arrayTagsToString($tags)
    {
        $result = "";

        foreach($tags as $tag)
        {
            if($tag->getTag())
                $result .= $tag->getTag()->getName().', ';
        }

        return substr($result, 0, -2);
    }

    private function barFirstImage($bar, Request $request)
    {
        $baseUrl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();

        $medias = $bar->getMedias();
        foreach($medias as $media)
        {
            return $baseUrl.$this->container->get($media->getMedia()->getProviderName())->generatePublicUrl($media->getMedia(), 'default_slider_large');
        }

        return null;
    }
}
