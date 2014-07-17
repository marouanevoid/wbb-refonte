<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdsController extends Controller
{
    public function showAction($position)
    {
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        $city = null;

        if(!empty($slug)){
            $city = $this->container->get('city.repository')->findOneBySlug($slug);
        }

        $ad = $this->get('ad.repository')->findOneByPositionAndCountry($position, $city->getCountry());

        $this->render('WBBBarBundle:Ads:show.html.twig', array(
                'ad' => $ad
            )
        );
    }
}
