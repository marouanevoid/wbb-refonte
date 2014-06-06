<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Repository\BarRepository;

class BarController extends Controller
{
    public function homeAction()
    {
        $topCities = $this->container->get('city.repository')->findTopCities();
        $response['topCities']  = shuffle($topCities);
        $response['topBars']    = $this->container->get('bar.repository')->findBestBars();
        $response['topBestofs'] = $this->container->get('bestof.repository')->findTopBestOfs();
        $response['topNews']    = $this->container->get('news.repository')->findLatestNews();
        $response['latestBars'] = $this->container->get('bar.repository')->findLatestBars();

        return $this->render('WBBBarBundle:Bar:homepage.html.twig', $response);
    }

    public function cityHomeAction($slug)
    {
        $city = $this->container->get('city.repository')->findOneBySlug($slug);

        $response['topBars']    = $this->container->get('bar.repository')->findBestBars($city);
        $response['topBestofs'] = $this->container->get('bestof.repository')->findTopBestOfs($city);
        $response['topNews']    = $this->container->get('news.repository')->findLatestNews($city);
        $response['latestBars'] = $this->container->get('bar.repository')->findLatestBars($city);

        return $this->render('WBBBarBundle:Bar:homepage.html.twig', $response);
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

        $response = $this->getYouMayAlsoLike($bar);

        return $this->render('WBBBarBundle:Bar:details.html.twig', array(
            'bar'       => $bar,
            'barLike'   => $response['bars'],
            'oneCity'   => $response['oneCity']
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
}
