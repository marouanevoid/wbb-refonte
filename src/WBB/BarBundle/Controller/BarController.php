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
        $response['popularBars']    = $this->container->get('bar.repository')->findPopularBars();
        $response['topBestofs']     = $this->container->get('bestof.repository')->findTopBestOfs(null, true, 5);
        $response['topNews']        = $this->container->get('news.repository')->findLatestNews(null, 3);
        $response['latestBars']     = $this->container->get('bar.repository')->findLatestBars(null, 5);

        return $this->render('WBBBarBundle:Bar:homepage.html.twig', $response);
    }

    public function citiesAction()
    {
        return $this->render('WBBBarBundle:Bar:cities.html.twig');
    }

    public function citiesListAction()
    {
        $cities = array
        (
            array('id'=>'nice-france', 'name'=>"Nice, France"),
            array('id'=>'madrid-espana', 'name'=>"Madrid, Espana"),
            array('id'=>'roma-italy', 'name'=>"Roma, Italy"),
            array('id'=>'new_york-new_york', 'name'=>"New York, New York"),
        );

        return new JsonResponse(array(
            'code'   => 200,
            'cities' => $cities
        ));
    }

    public function poiListAction(){
        $bars = array
        (
            array('id'=>'bar1', 'address'=>"189 Spring St, Soho, New York", 'name'=>"Achiles Heel", 'url'=>"/app_dev.php/bar/Agadir/Founty/Le-Jardin-De-Leau", 'image_url'=>"/app_dev.php/bundles/wbbcore/images/tmp/bar.jpg", 'tags'=>"rooftop, romance, ambiente"),
            array('id'=>'bar2', 'address'=>"163 Spring St, Soho, New York", 'name'=>"Alameda", 'url'=>"/app_dev.php/bar/Agadir/Founty/Le-Dome", 'image_url'=>"/app_dev.php/bundles/wbbcore/images/tmp/bar.jpg", 'tags'=>"rooftop, romance, ambiente"),
            array('id'=>'bar3', 'address'=>"220 Houston St, Soho, New York", 'name'=>"Atrium", 'url'=>"/app_dev.php/bar/Agadir/Founty/Le-Jardin-De-Leau", 'image_url'=>"/app_dev.php/bundles/wbbcore/images/tmp/bar.jpg", 'tags'=>"rooftop, romance, ambiente"),
            array('id'=>'bar4', 'address'=>"382 Prince  St, Soho, New York", 'name'=>"Bar Below Rye", 'url'=>"/app_dev.php/bar/Agadir/Founty/Le-Dome", 'image_url'=>"/app_dev.php/bundles/wbbcore/images/tmp/bar.jpg", 'tags'=>"rooftop, romance, ambiente"),
        );

        $neighborhood = array
        (
            array('id'=>1, 'name'=>"Neighborhood 1"),
            array('id'=>2, 'name'=>"Neighborhood 2"),
            array('id'=>3, 'name'=>"Neighborhood 3"),
            array('id'=>4, 'name'=>"Neighborhood 4"),
        );

        return new JsonResponse(array(
            'code'          => 200,
            'bars'          => $bars,
            'neighborhoods' => $neighborhood
        ));
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
}
