<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use WBB\BarBundle\Entity\Tip;
use WBB\BarBundle\Form\TipType;
use WBB\BarBundle\Repository\BarRepository;

class BarController extends Controller
{
    public function homeAction()
    {
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
        $city = $this->container->get('city.repository')->findOneBySlug($slug);
        $topCities = $this->container->get('city.repository')->findTopCities();
        shuffle($topCities);

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
        $response['topCities']      = $this->container->get('city.repository')->findTopCities();
        $response['popularBars']    = $this->container->get('bar.repository')->findPopularBars();
        $response['topBestofs']     = $this->container->get('bestof.repository')->findTopBestOfs(null, true, 5);
        // $response['nearestBars']    = $this->container->get('bar.repository')->findNearestBars();

        return $this->render('WBBBarBundle:BarGuide:barGuides.html.twig', $response);
    }

    public function barGuideCityAction($slug)
    {
        $city = $this->container->get('city.repository')->findOneBySlug($slug);

        $response['topCities']      = $this->container->get('city.repository')->findTopCities();
        $response['popularBars']    = $this->container->get('bar.repository')->findPopularBars($city);
        $response['topBestofs']     = $this->container->get('bestof.repository')->findTopBestOfs($city, true, 5);
        // $response['nearestBars']    = $this->container->get('bar.repository')->findNearestBars($city);

        return $this->render('WBBBarBundle:BarGuide:barGuides.html.twig', $response);
    }

    /**
     * detailsAction
     *
     * @param $city
     * @param $suburb
     * @param $slug
     *
     * @return Response
     */
    public function detailsAction($city, $suburb, $slug)
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

    // Returns a list of filtred bars or bestofs (used also for "see more bars/bestofs")
    public function barGuideFilterAction($barsOnly = 1, $city = 0, $filter = "popularity" , $offset = 0, $limit = 8, $display = 'grid')
    {
        $response = null;
        $type = null;

        if($barsOnly){
            if($filter === "popularity"){
                $response = $this->container->get('bar.repository')->findPopularBars($city, $limit, $offset);
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bar.repository')->findBarsOrderedByName($city, $offset ,$limit);
            }elseif($filter === "date"){
                $response = $this->container->get('bar.repository')->findLatestBars($city, $limit, $offset, false);
            }elseif($filter === "distance"){
                $response = $this->container->get('bar.repository')->findNearestBars(0, 0, $offset, $limit);
            }
            if($display=="grid"){
                return $this->render('WBBBarBundle:BarGuide:filters\bars.html.twig', array(
                    'bars'   => $response,
                    'offset' => $offset,
                    'limit'  => $limit
                ));
            }else{
                return $this->render('WBBBarBundle:BarGuide:filters\barsList.html.twig', array(
                    'bars'   => $response,
                    'offset' => $offset,
                    'limit'  => $limit
                ));
            }

        }else{
            if($filter === "popularity"){
                //TODO: Repository methode for popularity
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName($city, $offset ,$limit);
            }elseif($filter === "alphabetical"){
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName($city, $offset ,$limit);
            }elseif($filter === "date"){
                //$response = $this->container->get('bestof.repository')->findLatestBars($city, $limit, $offset, false);
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName($city, $offset ,$limit);
            }
            if($display=="grid"){
                return $this->render('WBBBarBundle:BarGuide/filters:bestofs.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            }else{
                return $this->render('WBBBarBundle:BarGuide/filters:bestofsList.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            }
        }
    }
}
