<?php

namespace WBB\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function loadProfileDataAction($content = 1, $filter = "date" , $offset = 0, $limit = 8, $display = 'grid')
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $response           = null;
        $all                = null;
        $nbResults          = null;
        $nbResultsRemaining = null;
        $html               = null;
        $distance           = false;

        if($content == "bars"){
            $session = $this->container->get('session');
            $latitude = $session->get('userLatitude' );
            $longitude = $session->get('userLongitude');
            if(!empty($latitude) && !empty($longitude))
                $distance = array(
                    'latitude'  => $latitude,
                    'longitude' => $longitude,
                    'city'      => $this->get('city.repository')->findOneBySlug($session->get('citySlug'))
                );

            if($filter === "alphabetical"){
                $response = $this->container->get('bar.repository')->findBarsOrderedByName(null, $offset, $limit, $user);
                $all = $this->container->get('bar.repository')->findBarsOrderedByName(null, $offset, 0, $user);
            }elseif($filter === "date"){
                $response = $this->container->get('bar.repository')->findLatestBars(null, $limit, $offset, false, $user);
                $all = $this->container->get('bar.repository')->findLatestBars(null, 0, $offset, false, $user);
            }elseif($filter === "city"){
                $response = $this->container->get('bar.repository')->findBarsOrderedByCityAndName($user, $offset, $limit);
                $all = $this->container->get('bar.repository')->findBarsOrderedByCityAndName($user, $offset, 0);
            }

            if($display=="grid"){
                $html = $this->renderView('WBBUserBundle:Profile:filters\bars.html.twig', array(
                        'bars'   => $response,
                        'offset' => $offset,
                        'limit'  => $limit,
                        'distance' => $distance
                    )
                );
            }else{
                $html = $this->renderView('WBBUserBundle:Profile:filters\barsList.html.twig', array(
                    'bars'   => $response,
                    'offset' => $offset,
                    'limit'  => $limit,
                    'distance' => $distance
                ));
            }

        }elseif($content == "bestofs"){

            if($filter === "city"){
                $response = $this->container->get('bestof.repository')->findBarsOrderedByCityAndName($user, $offset, $limit);
                $all = $this->container->get('bestof.repository')->findBarsOrderedByCityAndName($user, $offset, 0);
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset ,$limit, 'ASC', $user);
                $all = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset , 0, 'ASC', $user);
            }elseif($filter === "date"){
                $response = $this->container->get('bestof.repository')->findLatestBestofs(null, $limit, $offset, false, $user);
                $all = $this->container->get('bestof.repository')->findLatestBestofs(null, 0, $offset, false, $user);
            }
            if($display=="grid"){
                $html = $this->renderView('WBBUserBundle:Profile/filters:bestofs.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            }else{
                $html = $this->renderView('WBBUserBundle:Profile/filters:bestofsList.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            }
        }else{

            $response = $this->container->get('tip.repository')->findUserTips($user, $offset ,$limit);
            $all = $this->container->get('tip.repository')->findUserTips($user, $offset, 0);
            $html = $this->renderView('WBBUserBundle:Profile/filters:tip.html.twig', array(
                'tips'    => $response,
                'user'    => $user,
                'offset'  => $offset,
                'limit'   => $limit
            ));
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
