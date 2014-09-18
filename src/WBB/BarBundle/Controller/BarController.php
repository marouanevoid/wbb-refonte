<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use WBB\BarBundle\Entity\Tag;
use WBB\BarBundle\Entity\Tip;
use WBB\BarBundle\Form\TipType;
use WBB\BarBundle\Repository\BarRepository;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FilterUserResponseEvent;

class BarController extends Controller
{

    private function reGeolocate()
    {
        $session = $this->container->get('session');
        $cookies = $this->get('request')->cookies;

        if ($cookies->has('first_visite') == false || ( $cookies->has('first_visite') && $cookies->get('first_visite') != "false" ) ) {
            $geoSlug = $session->get('citySlugGeo');
            if (!empty($geoSlug)) {
                $session->set('citySlug', $geoSlug);
            }
        }
    }

    public function homeAction(Request $request)
    {
        $resettingForm = null;
        if ($request->query->get('token', null)) {
            $res = $this->resetAction($request, $request->query->get('token'));
            if (!is_array($res)) {
                $resettingForm = $res->getContent();
                if ($request->isXmlHttpRequest()) {
                    return $res;
                }
            } else {
                return $res[0];
            }
        }
        $this->reGeolocate();

        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        if (!empty($slug))
            return $this->cityHomeAction($session->get('citySlug'), $request, $resettingForm);
        $session->set('citySlug', "");

        $topCities = $this->container->get('city.repository')->findTopCities();
        shuffle($topCities);

        $response['topCities']  = $topCities;
        $response['topBars']    = $this->container->get('bar.repository')->findBestBars();
        $response['topBestofs'] = $this->container->get('bestof.repository')->findTopBestOfs();
        $response['topNews']    = $this->container->get('news.repository')->findLatestNews(null, 3);
        $response['latestBars'] = $this->container->get('bar.repository')->findLatestBars(null, 5);
        if ($resettingForm) {
            $response['resetting_form'] = $resettingForm;
        }

        return $this->render('WBBBarBundle:Bar:homepage.html.twig', $response);
    }

    private function resetAction(Request $request, $token)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.resetting.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $userManager->findUserByConfirmationToken($token);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with "confirmation token" does not exist for value "%s"', $token));
        }

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('wbb_user_reset_success');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::RESETTING_RESET_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return array($response);
            }
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Resetting:reset.html.twig', array(
            'token' => $token,
            'form' => $form->createView(),
        ));
    }

    public function cityHomeAction($slug, Request $request,  $resettingForm = null)
    {
        $this->reGeolocate();
        $session = $this->container->get('session');
        if ($slug == "world-wide") {
            $session->set('citySlug', "");

            return $this->homeAction($request);
        }

        if ($slug != $session->get('citySlug')) {
            $session->set('citySlug', $slug);
            $session->set('userLatitude', '');
            $session->set('userLongitude', '');
        }

        $city = $this->container->get('city.repository')->findOneBySlug($slug);
        $topCities = $this->container->get('city.repository')->findTopCities();
        shuffle($topCities);

        $latitude  = $session->get('userLatitude');
        $longitude = $session->get('userLongitude');

        if (!empty($latitude) && !empty($longitude)) {
            $response['distance']  = array(
                'latitude'  => $latitude,
                'longitude' => $longitude,
                'city'      => $city
            );
        } else {
            $response['distance'] = false;
        }

        $response['topCities']  = $topCities;
        $response['topBars']    = $this->container->get('bar.repository')->findBestBars($city);
        $response['topBestofs'] = $this->container->get('bestof.repository')->findTopBestOfs($city);
        $response['topNews']    = $this->container->get('news.repository')->findLatestNews($city);
        $response['latestBars'] = $this->container->get('bar.repository')->findLatestBars($city);
        $response['city']       = $city;
        if ($resettingForm) {
            $response['resetting_form'] = $resettingForm;
        }

        return $this->render('WBBBarBundle:Bar:homepage.html.twig', $response);
    }

    public function barGuideAction()
    {
        $this->reGeolocate();
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        if (!empty($slug))
            return $this->barGuideCityAction($session->get('citySlug'));
        $session->set('citySlug', "");
        $response['distance'] = false;

        $response['topCities']      = $this->container->get('city.repository')->findTopCities();
        $response['popularBars']    = $this->container->get('bar.repository')->findPopularBars();
        $response['topBestofs']     = $this->container->get('bestof.repository')->findTopBestOfs(null, true, 5, false);

        return $this->render('WBBBarBundle:BarGuide:barGuides.html.twig', $response);
    }

    public function barGuideCityAction($slug)
    {
        $this->reGeolocate();
        $session = $this->container->get('session');
        if ($slug == "world-wide") {
            $session->set('citySlug', "");

            return $this->barGuideAction();
        }

        if ($slug != $session->get('citySlug')) {
            $session->set('citySlug', $slug);
            $session->set('userLatitude', '');
            $session->set('userLongitude', '');
        }

        $city = $this->container->get('city.repository')->findOneBySlug($slug);

        $latitude = $session->get('userLatitude' );
        $longitude = $session->get('userLongitude');

        if (!empty($latitude) && !empty($longitude) && !empty($slug)) {
            $response['nearestBars'] = $this->container->get('bar.repository')->findNearestBars($city, $latitude, $longitude);
            $response['distance']  = array(
                'latitude'  => $latitude,
                'longitude' => $longitude,
                'city'      => $city
            );
        } else {
            $response['distance']  = false;
        }

        $response['topCities']     = $this->container->get('city.repository')->findTopCities();
        $response['popularBars']   = $this->container->get('bar.repository')->findPopularBars($city);
        $response['topBestofs']    = $this->container->get('bestof.repository')->findTopBestOfs($city, true, 5, false);
        $response['city']          = $city;

        return $this->render('WBBBarBundle:BarGuide:barGuides.html.twig', $response);
    }

    /**
     * detailsAction
     *
     * @param $slug
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return Response
     */
    public function detailsAction($slug)
    {
        $session = $this->container->get('session');
        $distance = array();
        $city = $session->get('citySlug');
        $latitude = $session->get('userLatitude');
        $longitude = $session->get('userLongitude');

        if (!empty($city) && !empty($latitude) && !empty($longitude)) {
            $distance['latitude']   = $latitude;
            $distance['longitude']  = $longitude;
            $distance['city']         = $this->get('city.repository')->findOneBySlug($city);
        }

        $bar = $this->container->get('bar.repository')->findBarBySlug($slug);
        if (!$bar) {
            throw $this->createNotFoundException('Object not found!');
        }

        $user = $this->container->get('user.repository')->findOneById(1);

        $topRelatedBestOfs = $this->container->get('bestof.repository')->findBarRelatedBestofs($bar, true);
        $topRelatedNews = $this->container->get('news.repository')->findBarRelatedNews($bar, true);
        $relatedBestOfs = $this->container->get('bestof.repository')->findBarRelatedBestofs($bar, false);
        $relatedNews = $this->container->get('news.repository')->findBarRelatedNews($bar, false);

        $related = array_merge($topRelatedNews, $topRelatedBestOfs, $relatedNews, $relatedBestOfs);

        $response = $this->getYouMayAlsoLike($bar);

        $tip = new Tip();
        $tip
            ->setUser($user)
            ->setBar($bar)
            ->setStatus(1);

        $form = $this->createForm(new TipType(), $tip, array('em' => $this->container->get('doctrine.orm.entity_manager')));

        return $this->render('WBBBarBundle:Bar:details.html.twig', array(
            'bar'       => $bar,
            'related'   => $related,
            'barLike'   => $response['bars'],
            'oneCity'   => $response['oneCity'],
            'tipForm'   => $form->createView(),
            'distance'  => $distance
        ));
    }

    public function barFinderAction(Request $request)
    {
        $this->reGeolocate();
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        $city = null;

        $selected = array(
            'mood'      => urldecode($request->query->get('sel_mood')),
            'city'      => $request->query->get('sel_city'),
            'outWith'   => $request->query->get('sel_outwith')
        );

        if (!empty($slug))
            $city = $this->get('city.repository')->findOneBySlug($slug);

        $toGoOutWith    = $this->container->get('tag.repository')->findByType(Tag::WBB_TAG_TYPE_WITH_WHO);

        $moods          = array(
            'Chill Out',
            'Casual',
            'Party'
        );
        $cities = $this->container->get('city.repository')->findBarFinderCities($city);

        return $this->render('WBBBarBundle:BarFinder:Mobile\barFinderForm.html.twig', array(
            'city'      => $city,
            'cities'    => $cities,
            'firstTags' => $toGoOutWith,
            'moods'     => $moods,
            'selected'  => $selected
        ));
    }

    public function barFinderFormAction()
    {
        $this->reGeolocate();
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');

        $selected = array(
            'mood'      => urldecode($session->get('barfinder_mood')),
            'city'      => $session->get('barfinder_city'),
            'outWith'   => $session->get('barfinder_tag')
        );

        $city = null;
        if (!empty($slug))
            $city = $this->get('city.repository')->findOneBySlug($slug);

        $toGoOutWith    = $this->container->get('tag.repository')->findByType(Tag::WBB_TAG_TYPE_WITH_WHO);
        $moods          = array(
            'chillout'  => 'Chill Out',
            'casual'    => 'Casual',
            'party'     => 'Party'
        );
//        $moods          = $this->container->get('tag.repository')->findByType(Tag::WBB_TAG_TYPE_ENERGY_LEVEL, null, 3);
        $cities         = $this->container->get('city.repository')->findBarFinderCities($city);

        return $this->render('WBBBarBundle:BarFinder:barFinderForm.html.twig', array(
            'city'      => $city,
            'cities'    => $cities,
            'firstTags' => $toGoOutWith,
            'moods'     => $moods,
            'selected'  => $selected
        ));
    }

    public function barFinderResultsAction(Request $request)
    {
        $mood= null;
        $city = null;
        $tag = null;

        $session = $this->container->get('session');
        if ($request->request->get('mood') != "") {
            $mood  = $this->get('tag.repository')->findByType(Tag::WBB_TAG_TYPE_ENERGY_LEVEL, false, 1, $request->request->get('mood'));
            $session->set('barfinder_mood', $mood);
        } else {
            $session->set('barfinder_mood', "empty");
        }

        if ($request->request->get('city') != "") {
            if ($request->request->get('city') != 'all')
                $city = $this->container->get('city.repository')->findOneBySlug($request->request->get('city'));
            $session->set('barfinder_city', $request->request->get('city'));
        }

        if ($request->request->get('go_out') != "") {
            if ($request->request->get('go_out') != 'all')
                $tag = $request->request->get('go_out');
            $session->set('barfinder_tag', $request->request->get('go_out'));
        }

        $selected = array(
            'mood'      => urldecode($session->get('barfinder_mood')),
            'city'      => $session->get('barfinder_city'),
            'outWith'   => $session->get('barfinder_tag')
        );

        $bars = $this->container->get('bar.repository')->findBarFromFinder($city, $tag, $mood);

        $latitude  = $session->get('userLatitude');
        $longitude = $session->get('userLongitude');
        $distance = false;

        if (!empty($latitude) && !empty($longitude)) {
            $distance  = array(
                'latitude'  => $latitude,
                'longitude' => $longitude,
                'city'      => $this->get('city.repository')->findOneBySlug($session->get('citySlug'))
            );
        }

        return $this->render('WBBBarBundle:BarFinder:barFinderResults.html.twig', array(
            'bars'      => $bars,
            'distance'  => $distance,
            'selected'  => $selected
        ));
    }

    public function bestOfAction($bestOfSlug, $citySlug = false)
    {
        $em = $this->getDoctrine()->getManager();
        $bestOf = $em->getRepository('WBBBarBundle:BestOf')->findOneBySlug($bestOfSlug);
        $bestOfs = array();
        $bars = null;
        $byCity = ($citySlug)? true : null;

        if (!$bestOf) {
            // TODO Does not work !
            $this->createNotFoundException('Not found !');
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

    // Returns a list of filtred bars or bestofs (used also for "see more bars/bestofs")
    public function barGuideFilterAction($barsOnly = 1, $city = 0, $filter = "popularity" , $offset = 0, $limit = 8, $display = 'grid')
    {
        $response           = null;
        $all                = null;
        $nbResults          = null;
        $nbResultsRemaining = null;
        $html               = null;

        $latitude   = null;
        $longitude  = null;
        $distance   = false;

        $cityObject = $this->container->get('city.repository')->findOneById($city);

        if ($barsOnly) {
            if ($filter === "popularity") {
                $response = $this->container->get('bar.repository')->findPopularBars($cityObject, $limit, $offset);
                $all = $this->container->get('bar.repository')->findPopularBars($cityObject, 0, $offset);
            } elseif ($filter === "alphabetical") {
                $response = $this->container->get('bar.repository')->findBarsOrderedByName($cityObject, $offset ,$limit);
                $all = $this->container->get('bar.repository')->findBarsOrderedByName($cityObject, $offset , 0);
            } elseif ($filter === "date") {
                $response = $this->container->get('bar.repository')->findLatestBars($cityObject, $limit, $offset, false);
                $all = $this->container->get('bar.repository')->findLatestBars($cityObject, 0, $offset, false);
            } elseif ($filter === "distance") {
                $session = $this->container->get('session');
                $distance  = array(
                    'latitude'  => $session->get('userLatitude' ),
                    'longitude' => $session->get('userLongitude'),
                    'city'      => $this->get('city.repository')->findOneBySlug($session->get('citySlug'))
                );
                $response = $this->container->get('bar.repository')->findNearestBars($cityObject, $latitude, $longitude, $offset, $limit);
                $all = $this->container->get('bar.repository')->findNearestBars($cityObject, $latitude, $longitude, $offset, 0);
            }

            if ($display=="grid") {
                $html = $this->renderView('WBBBarBundle:BarGuide:filters\bars.html.twig', array(
                        'bars'   => $response,
                        'offset' => $offset,
                        'limit'  => $limit,
                        'distance' => $distance
                    )
                );
            } else {
                $html = $this->renderView('WBBBarBundle:BarGuide:filters\barsList.html.twig', array(
                    'bars'   => $response,
                    'offset' => $offset,
                    'limit'  => $limit,
                    'distance' => $distance
                ));
            }

        } else {
            if ($filter === "popularity") {
                //TODO: Repository methode for popularity
                $response = $this->container->get('bestof.repository')->findPopularBestofs($cityObject, $offset, $limit);
                $all = $this->container->get('bestof.repository')->findPopularBestofs($cityObject, $offset, 0);
            } elseif ($filter === "alphabetical") {
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName($cityObject, $offset ,$limit);
                $all = $this->container->get('bestof.repository')->findBestofOrderedByName($cityObject, $offset, 0);
            } elseif ($filter === "date") {
                $response = $this->container->get('bestof.repository')->findLatestBestofs($cityObject, $limit, $offset, false);
                $all = $this->container->get('bestof.repository')->findLatestBestofs($cityObject, 0, $offset, false);
            }
            if ($display=="grid") {
                $html = $this->renderView('WBBBarBundle:BarGuide/filters:bestofs.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            } else {
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

    public function getBarsByNameAction(Request $request)
    {
        $term = $request->get('term');
        $bars = $this->container->get('bar.repository')->findBarsLike($term, 5);

        $json = array();

        foreach ($bars as $bar) {
            $json[] = array(
                'value' => $bar->getName(),
                'id'    => $bar->getName()
            );
        }

        return new JsonResponse($json);
    }

    private function getYouMayAlsoLike($bar)
    {
        //Get Bars OnTop + ByTags + InCity
        $youMayAlsoLike = $this->container->get('bar.repository')->findYouMayAlsoLike($bar, BarRepository::BAR_LOCATION_CITY);
        $oneCity = true;
        $size = sizeof($youMayAlsoLike);
        if ($size < 4) {
            //Get Bars OnTop + ByTags + InCountry
            $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                BarRepository::BAR_LOCATION_COUNTRY, $youMayAlsoLike, true, true ,(4 - $size)
            );
            if (sizeof($temp) > 0) {
                $oneCity = false;
                foreach ($temp as $tmp) {
                    $youMayAlsoLike[] = $tmp;
                }
            }

            //Get Bars OnTop + ByTags + Worldwide
            $size += sizeof($temp);
            if ($size < 4) {
                $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                    BarRepository::BAR_LOCATION_WORLDWIDE, $youMayAlsoLike, true, true ,(4 - $size)
                );

                if (sizeof($temp)>0) {
                    $oneCity = false;
                    foreach ($temp as $tmp) {
                        $youMayAlsoLike[] = $tmp;
                    }
                }

                //Get Bars OnTop + InCity
                $size += sizeof($temp);
                if ($size < 4) {
                    $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                        BarRepository::BAR_LOCATION_CITY, $youMayAlsoLike, true, false ,(4 - $size)
                    );

                    if (sizeof($temp) > 0) {
                        foreach ($temp as $tmp) {
                            $youMayAlsoLike[] = $tmp;
                        }
                    }

                    //Get Bars OnTop + InCountry
                    $size += sizeof($temp);
                    if ($size < 4) {
                        $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                            BarRepository::BAR_LOCATION_COUNTRY, $youMayAlsoLike, true, false ,(4 - $size)
                        );

                        if (sizeof($temp) > 0) {
                            $oneCity = false;
                            foreach ($temp as $tmp) {
                                $youMayAlsoLike[] = $tmp;
                            }
                        }

                        //Get Bars OnTop + InWorldwide
                        $size += sizeof($temp);
                        if ($size < 4) {
                            $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                                BarRepository::BAR_LOCATION_WORLDWIDE, $youMayAlsoLike, true, false ,(4 - $size)
                            );

                            if (sizeof($temp) > 0) {
                                $oneCity = false;
                                foreach ($temp as $tmp) {
                                    $youMayAlsoLike[] = $tmp;
                                }
                            }
                        }
                    }
                }
            }
        }

        return array(
            'bars'      =>  $youMayAlsoLike,
            'oneCity'   =>  $oneCity
        );
    }

    private function getBarFinderMoods()
    {
        $moodsFound = $this->container->get('tag.repository')->findBarFinderMoods();
        $moods = array();
        foreach ($moodsFound as $mood) {
            $moods[] = $mood['name'];
        }

        return $moods;
    }
}
