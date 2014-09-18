<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WBB\BarBundle\Entity\Ad;

class AdsController extends Controller
{
    public function showAction($format)
    {
        $size = explode('_', $format);
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        $city = null;
        if (!empty($slug)) {
            $city = $this->container->get('city.repository')->findOneBySlug($slug);
        }
        $ad = $this->get('ad.repository')->findOneByPositionAndCountry($format, ($city)?$city->getCountry():null);
        if ($city && !$ad) {
            $ad = $this->get('ad.repository')->findOneByPositionAndCountry($format, null);
        }

        return $this->render('WBBBarBundle:Ads:show.html.twig', array(
                'ad'     => $ad,
                'format' => $size[1],
                'NLP'    => false
            )
        );
    }
}
