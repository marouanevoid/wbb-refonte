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
