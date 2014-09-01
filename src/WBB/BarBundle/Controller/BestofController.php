<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BestofController extends Controller
{
    public function bestOfAction($bestOfSlug, $citySlug = false)
    {
        $em = $this->getDoctrine()->getManager();
        $bestOf = $em->getRepository('WBBBarBundle:BestOf')->findOneBySlug($bestOfSlug);
        $bestOfs = array();
        $bars = null;
        $byCity = ($citySlug)? true : null;

        if (!$bestOf) {
            throw new NotFoundHttpException('Best of not found');
        }

        foreach ($bestOf->getBestofs() as $bo) {
            $bestOfs[] = $bo;
        }

        $bestofsCount = count($bestOfs);

        if ($bestofsCount < 3) {
            $bestOfsTmp = $this->get('bestof.repository')->findYouMayAlsoLike($bestOf, $byCity, (3 - $bestofsCount));
            $bestofsCount += count($bestOfsTmp);
            foreach ($bestOfsTmp as $bo) {
                $bestOfs[] = $bo;
            }
            if ($bestofsCount < 3) {
                $bestOfsTmp = $this->get('bestof.repository')->findYouMayAlsoLike($bestOf, $byCity, (3 - $bestofsCount), false, $bestOfsTmp);
                foreach ($bestOfsTmp as $bo) {
                    $bestOfs[] = $bo;
                }
            }
        }

        if ($bestOf->getByTag()) {
            $barsTmp = $this->container->get('bar.repository')->findBarsByExactTags($bestOf);
            foreach ($barsTmp as $bar) {
                $bars[] = $bar;
            }
        } else {
            foreach ($bestOf->getBars() as $bar) {
                $bars[] = $bar;
            }
        }

        if (!$bestOf->getOrdered() && $bars) {
            shuffle($bars);
        }

        $session = $this->container->get('session');
        $latitude  = $session->get('userLatitude');
        $longitude = $session->get('userLongitude');
        $distance = false;

        if (!empty($latitude) && !empty($longitude) && ($citySlug != $session->get('citySlug'))) {
            $distance  = array(
                'latitude'  => $latitude,
                'longitude' => $longitude,
                'city'      => $this->get('city.repository')->findOneBySlug($session->get('citySlug'))
            );
        }

        return $this->render('WBBBarBundle:BestOf:details_global.html.twig',
            array(
                'bestOf'    => $bestOf,
                'bestofs'   => $bestOfs,
                'bars'      => $bars,
                'distance'  => $distance
            ));
    }
}
