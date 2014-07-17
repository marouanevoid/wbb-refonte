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

        if(!empty($slug)){
            $city = $this->container->get('city.repository')->findOneBySlug($slug);
        }

        $ad = $this->get('ad.repository')->findOneByPositionAndCountry($format, ($city)?$city->getCountry():null);

        return $this->render('WBBBarBundle:Ads:show.html.twig', array(
                'ad'    => $ad,
                'format' => $size[1]
            )
        );
    }

    public function showNLPRightBannerAction()
    {
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        $city = null;
        $format = Ad::WBB_ADS_NLP_300x600;

        if(!empty($slug)){
            $city = $this->container->get('city.repository')->findOneBySlug($slug);
        }

        $ad = $this->get('ad.repository')->findOneByPositionAndCountry($format, ($city) ? $city->getCountry():null);

        if(!$ad){
            $format = Ad::WBB_ADS_NLP_300x250;
            $ad = $this->get('ad.repository')->findOneByPositionAndCountry($format, ($city) ? $city->getCountry():null);
        }

        $size = explode('_', $format);

        return $this->render('WBBBarBundle:Ads:show.html.twig', array(
                'ad'    => $ad,
                'format' => $size[1]
            )
        );
    }
}
