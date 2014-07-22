<?php

namespace WBB\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function loadProfileDataAction($barsOnly = 1, $filter = "date" , $offset = 0, $limit = 8, $display = 'grid')
    {
        $response           = null;
        $all                = null;
        $nbResults          = null;
        $nbResultsRemaining = null;
        $html               = null;

        $distance   = false;

        if($barsOnly){
            $session = $this->container->get('session');
            $latitude = $session->get('userLatitude' );
            $longitude = $session->get('userLongitude');
            if(!empty($latitude) && !empty($longitude))
                $distance = true;

            if($filter === "alphabetical"){
                $response = $this->container->get('bar.repository')->findBarsOrderedByName(null, $offset ,$limit);
                $all = $this->container->get('bar.repository')->findBarsOrderedByName(null, $offset , 0);
            }elseif($filter === "date"){
                $response = $this->container->get('bar.repository')->findLatestBars(null, $limit, $offset, false);
                $all = $this->container->get('bar.repository')->findLatestBars(null, 0, $offset, false);
            }elseif($filter === "city"){
                $response = $this->container->get('bar.repository')->findNearestBars(null, $latitude, $longitude, $offset, $limit);
                $all = $this->container->get('bar.repository')->findNearestBars(null, $latitude, $longitude, $offset, 0);
            }

            if($display=="grid"){
                $html = $this->renderView('WBBBarBundle:BarGuide:filters\bars.html.twig', array(
                        'bars'   => $response,
                        'offset' => $offset,
                        'limit'  => $limit,
                        'distance' => $distance,
                        'latitude' => $latitude,
                        'longitude'=> $longitude
                    )
                );
            }else{
                $html = $this->renderView('WBBBarBundle:BarGuide:filters\barsList.html.twig', array(
                    'bars'   => $response,
                    'offset' => $offset,
                    'limit'  => $limit,
                    'distance' => $distance,
                    'latitude' => $latitude,
                    'longitude'=> $longitude
                ));
            }

        }else{
            if($filter === "city"){
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset, $limit, 'DESC');
                $all = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset, 0, 'DESC');
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset ,$limit);
                $all = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset, 0);
            }elseif($filter === "date"){
                $response = $this->container->get('bestof.repository')->findLatestBestofs(null, $limit, $offset, false);
                $all = $this->container->get('bestof.repository')->findLatestBestofs(null, 0, $offset, false);
            }
            if($display=="grid"){
                $html = $this->renderView('WBBBarBundle:BarGuide/filters:bestofs.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            }else{
                $html = $this->renderView('WBBBarBundle:BarGuide/filters:bestofsList.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            }
        }

        $nbResults = count($response);
        $nbResultsRemaining = count($all) - $nbResults;

        return new JsonResponse(
            array(
                'htmldata'   => $html,
                'nbResults'  => $nbResults,
                'difference' => $nbResultsRemaining
            )
        );
    }
}
