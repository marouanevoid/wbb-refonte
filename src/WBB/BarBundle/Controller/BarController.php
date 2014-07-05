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
use Symfony\Component\HttpFoundation\Session\Session;

class BarController extends Controller
{
    public function homeAction()
    {
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        if (!empty($slug))
           return $this->cityHomeAction($session->get('citySlug'));
        $session->set('citySlug', "");

        $topCities = $this->container->get('city.repository')->findTopCities();
        shuffle($topCities);

        $response['topCities']  = $topCities;
        $response['topBars']    = $this->container->get('bar.repository')->findBestBars();
        $response['topBestofs'] = $this->container->get('bestof.repository')->findTopBestOfs();
        $response['topNews']    = $this->container->get('news.repository')->findLatestNews(null, 3);
        $response['latestBars'] = $this->container->get('bar.repository')->findLatestBars(null, 5);

        return $this->render('WBBBarBundle:Bar:homepage.html.twig', $response);
    }

    public function cityHomeAction($slug)
    {
        $session = $this->container->get('session');
        if ($slug == "world-wide")
        {
            $session->set('citySlug', "");
            return $this->homeAction();
        }
        $city = $this->container->get('city.repository')->findOneBySlug($slug);
        $topCities = $this->container->get('city.repository')->findTopCities();
        shuffle($topCities);


        $session->set('citySlug', $slug);

        $response['topCities']  = $topCities;
        $response['topBars']    = $this->container->get('bar.repository')->findBestBars($city);
        $response['topBestofs'] = $this->container->get('bestof.repository')->findTopBestOfs($city);
        $response['topNews']    = $this->container->get('news.repository')->findLatestNews($city);
        $response['latestBars'] = $this->container->get('bar.repository')->findLatestBars($city);
        $response['city']       = $city;

        return $this->render('WBBBarBundle:Bar:homepage.html.twig', $response);
    }

    public function barGuideAction()
    {
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        if (!empty($slug))
            return $this->barGuideCityAction($session->get('citySlug'));
        $session->set('citySlug', "");

        $latitude  = $session->get('userLatitude');
        $longitude = $session->get('userLongitude');

        if(!empty($latitude) and !empty($longitude)){
            $response['nearestBars'] = $this->container->get('bar.repository')->findNearestBars(null, $latitude, $longitude);
            $response['distance'] = true;
        }else{
            $response['distance'] = false;
        }

        $response['topCities']      = $this->container->get('city.repository')->findTopCities();
        $response['popularBars']    = $this->container->get('bar.repository')->findPopularBars();
        $response['topBestofs']     = $this->container->get('bestof.repository')->findTopBestOfs(null, true, 5, false);
//

        return $this->render('WBBBarBundle:BarGuide:barGuides.html.twig', $response);
    }

    public function barGuideCityAction($slug)
    {
        $session = $this->container->get('session');
        if ($slug == "world-wide")
        {
            $session->set('citySlug', "");
            return $this->barGuideAction();
        }

        $session->set('citySlug', $slug);
        $city = $this->container->get('city.repository')->findOneBySlug($slug);

        if(!empty($latitude) and !empty($longitude)){
            $response['nearestBars'] = $this->container->get('bar.repository')->findNearestBars($city, $latitude, $longitude);
            $response['distance'] = true;
        }else{
            $response['distance'] = false;
        }

        $response['topCities']      = $this->container->get('city.repository')->findTopCities();
        $response['popularBars']    = $this->container->get('bar.repository')->findPopularBars($city);
        $response['topBestofs']     = $this->container->get('bestof.repository')->findTopBestOfs($city, true, 5, false);
        $response['city']           = $city;

        return $this->render('WBBBarBundle:BarGuide:barGuides.html.twig', $response);
    }

    /**
     * detailsAction
     *
     * @param $slug
     * @return Response
     */
    public function detailsAction($slug)
    {
        $bar = $this->container->get('bar.repository')->findOneBySlug($slug);
        $user = $this->container->get('user.repository')->findOneById(1);

        $response = $this->getYouMayAlsoLike($bar);

        $tip = new Tip();
        $tip
            ->setUser($user)
            ->setBar($bar)
            ->setStatus(1);

        $form = $this->createForm(new TipType(), $tip, array('em' => $this->container->get('doctrine.orm.entity_manager')));

        return $this->render('WBBBarBundle:Bar:details.html.twig', array(
            'bar'       => $bar,
            'barLike'   => $response['bars'],
            'oneCity'   => $response['oneCity'],
            'tipForm'   => $form->createView()
        ));
    }

    public function barFinderFormAction()
    {
        $toGoOutWith    = $this->container->get('tag.repository')->findOccasionTags();
        $cities         = $this->container->get('city.repository')->findBarFinderCities();

        return $this->render('WBBBarBundle:BarFinder:barFinderForm.html.twig', array(
            'cities'    => $cities,
            'firstTags' => $toGoOutWith
        ));
    }

    public function barFinderResultsAction(Request $request)
    {
        $mood= null;
        $city = null;
        $tag = null;

        if($request->request->get('mood') != "")
        {
            $mood = array_search(ucfirst($request->request->get('mood')), Tag::getEnergyLevels());
        }

        if($request->request->get('city') != "")
        {
            $city = $this->container->get('city.repository')->findOneBySlug($request->request->get('city'));
        }

        if($request->request->get('go_out') != "")
        {
            $tag = $request->request->get('go_out');
        }

        $bars = $this->container->get('bar.repository')->findBarFromFinder($city, $tag, $mood);

        return $this->render('WBBBarBundle:BarFinder:barFinderResults.html.twig', array(
            'bars' => $bars
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

        foreach($bestOf->getBestofs() as $bo)
        {
            $bestOfs[] = $bo;
        }

        $bestofsCount = count($bestOfs);

        if ($bestofsCount < 3) {
            $bestOfsTmp = $this->get('bestof.repository')->findYouMayAlsoLike($bestOf, $byCity, (3 - $bestofsCount));
            $bestofsCount += count($bestOfsTmp);
            foreach($bestOfsTmp as $bo)
            {
                $bestOfs[] = $bo;
            }
            if($bestofsCount < 3){
                $bestOfsTmp = $this->get('bestof.repository')->findYouMayAlsoLike($bestOf, $byCity, (3 - $bestofsCount), false, $bestOfsTmp);
                foreach($bestOfsTmp as $bo)
                {
                    $bestOfs[] = $bo;
                }
            }
        }

        if($bestOf->getByTag()){
            $barsTmp = $this->container->get('bar.repository')->findBarsByExactTags($bestOf);
            foreach($barsTmp as $bar){
                $bars[] = $bar;
            }
        }else{
            foreach($bestOf->getBars() as $bar){
                $bars[] = $bar;
            }
        }

        if(!$bestOf->getOrdered() and $bars){
            shuffle($bars);
        }

        return $this->render('WBBBarBundle:BestOf:details_global.html.twig',
            array(
                'bestOf'   => $bestOf,
                'bestofs'  => $bestOfs,
                'bars'     => $bars
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

        $cityObject = $this->container->get('city.repository')->findOneById($city);

        if($barsOnly){
            if($filter === "popularity"){
                $response = $this->container->get('bar.repository')->findPopularBars($cityObject, $limit, $offset);
                $all = $this->container->get('bar.repository')->findPopularBars($cityObject, 0, $offset);
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bar.repository')->findBarsOrderedByName($cityObject, $offset ,$limit);
                $all = $this->container->get('bar.repository')->findBarsOrderedByName($cityObject, $offset , 0);
            }elseif($filter === "date"){
                $response = $this->container->get('bar.repository')->findLatestBars($cityObject, $limit, $offset, false);
                $all = $this->container->get('bar.repository')->findLatestBars($cityObject, 0, $offset, false);
            }elseif($filter === "distance"){
                $response = $this->container->get('bar.repository')->findNearestBars(0, 0, $offset, $limit);
                $all = $this->container->get('bar.repository')->findNearestBars(0, 0, $offset, 0);
            }

            if($display=="grid"){
                $html = $this->renderView('WBBBarBundle:BarGuide:filters\bars.html.twig', array(
                        'bars'   => $response,
                        'offset' => $offset,
                        'limit'  => $limit
                    )
                );
            }else{
                $html = $this->renderView('WBBBarBundle:BarGuide:filters\barsList.html.twig', array(
                    'bars'   => $response,
                    'offset' => $offset,
                    'limit'  => $limit
                ));
            }

        }else{
            if($filter === "popularity"){
                //TODO: Repository methode for popularity
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName($cityObject, $offset, $limit, 'DESC');
                $all = $this->container->get('bestof.repository')->findBestofOrderedByName($cityObject, $offset, 0, 'DESC');
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName($cityObject, $offset ,$limit);
                $all = $this->container->get('bestof.repository')->findBestofOrderedByName($cityObject, $offset, 0);
            }elseif($filter === "date"){
                $response = $this->container->get('bestof.repository')->findLatestBestofs($cityObject, $limit, $offset, false);
                $all = $this->container->get('bestof.repository')->findLatestBestofs($cityObject, 0, $offset, false);
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

    private function getYouMayAlsoLike($bar)
    {
        //Get Bars OnTop + ByTags + InCity
        $youMayAlsoLike = $this->container->get('bar.repository')->findYouMayAlsoLike($bar, BarRepository::BAR_LOCATION_CITY);
        $oneCity = true;
        $size = sizeof($youMayAlsoLike);
        if($size < 4)
        {
            //Get Bars OnTop + ByTags + InCountry
            $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                BarRepository::BAR_LOCATION_COUNTRY, $youMayAlsoLike, true, true ,(4 - $size)
            );
            if(sizeof($temp) > 0){
                $oneCity = false;
                foreach($temp as $tmp){
                    $youMayAlsoLike[] = $tmp;
                }
            }

            //Get Bars OnTop + ByTags + Worldwide
            $size += sizeof($temp);
            if($size < 4)
            {
                $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                    BarRepository::BAR_LOCATION_WORLDWIDE, $youMayAlsoLike, true, true ,(4 - $size)
                );

                if(sizeof($temp)>0){
                    $oneCity = false;
                    foreach($temp as $tmp){
                        $youMayAlsoLike[] = $tmp;
                    }
                }

                //Get Bars OnTop + InCity
                $size += sizeof($temp);
                if($size < 4)
                {
                    $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                        BarRepository::BAR_LOCATION_CITY, $youMayAlsoLike, true, false ,(4 - $size)
                    );

                    if(sizeof($temp) > 0){
                        foreach($temp as $tmp){
                            $youMayAlsoLike[] = $tmp;
                        }
                    }

                    //Get Bars OnTop + InCountry
                    $size += sizeof($temp);
                    if($size < 4)
                    {
                        $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                            BarRepository::BAR_LOCATION_COUNTRY, $youMayAlsoLike, true, false ,(4 - $size)
                        );

                        if(sizeof($temp) > 0){
                            $oneCity = false;
                            foreach($temp as $tmp){
                                $youMayAlsoLike[] = $tmp;
                            }
                        }

                        //Get Bars OnTop + InWorldwide
                        $size += sizeof($temp);
                        if($size < 4)
                        {
                            $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar,
                                BarRepository::BAR_LOCATION_WORLDWIDE, $youMayAlsoLike, true, false ,(4 - $size)
                            );

                            if(sizeof($temp) > 0){
                                $oneCity = false;
                                foreach($temp as $tmp){
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
}
