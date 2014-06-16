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

    public function citiesListAction()
    {
        $cities = $this->container->get('city.repository')->findCitiesWithBars();

        $response = array();

        foreach($cities as $city)
        {
            $response[] = array(
                'id'        => $city->getSlug(),
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

    public function poiListAction()
    {
        $bars = $this->container->get('bar.repository')->findAllEnabled();
        $suburbs = $this->container->get('suburb.repository')->findAll();
        $result = array('bars' => array(), 'suburbs' => array());

        foreach($bars as $bar)
        {
            $result['bars'][] = array(
                'id'        => $bar->getSlug(),
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
    }

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
