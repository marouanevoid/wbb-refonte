<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WBB\BarBundle\Entity\Ad;
use WBB\BarBundle\Entity\News;

class NewsController extends Controller
{
    private function reGeolocate(){

        $session = $this->container->get('session');
        $cookies = $this->get('request')->cookies;

        if($cookies->has('first_visite') == false || ( $cookies->has('first_visite') && $cookies->get('first_visite') != "false" ) ){
            $geoSlug = $session->get('citySlugGeo');
            if(!empty($geoSlug))
            {
                $session->set('citySlug', $geoSlug);
            }
        }
    }

    public function landingPageAction($citySlug = false)
    {
        $this->reGeolocate();
        $session = $this->container->get('session');
        if ($citySlug == "world-wide")
            $session->set('citySlug', "");

        if($citySlug != $session->get('citySlug') && $citySlug){
            $session->set('citySlug', $citySlug);
            $session->set('userLatitude', '');
            $session->set('userLongitude', '');
        }

        $slug = $session->get('citySlug');

        $city = null;
        if (!empty($slug)){
            $city = $this->get('city.repository')->findOneBySlug($slug);
        }elseif($citySlug){
            $city = ($citySlug)? $this->container->get('city.repository')->findOneBySlug($citySlug) : null;
        }

        $allNews = $this->container->get('news.repository')->findLatestNews($city, 0, false);

        $latestNews = array_slice($allNews, 0, 10, true);

        $articles = array();
        $interviews = array();
        $newsList = array();

        $nbArticles = 0;
        $nbInteviews = 0;

        foreach($allNews as $news)
        {
            if($news->isInterview() && $nbInteviews < 4 ){
                $interviews[] = $news;
                $nbInteviews++;
            }elseif(!$news->isInterview() && $nbArticles < 8){
                $articles[] = $news;
                $nbArticles++;
            }else{
                $newsList[] = $news;
            }
        }
        $topCities = $this->container->get('city.repository')->findTopCities();
        shuffle($topCities);

        $ads['bigAd'] = $this->get('ad.repository')->findOneByPositionAndCountry(Ad::WBB_ADS_NLP_300X600, ($city) ? $city->getCountry():null);
        $ads['smallAd'] = $this->get('ad.repository')->findOneByPositionAndCountry(Ad::WBB_ADS_NLP_300X250, ($city) ? $city->getCountry():null);

        return $this->render('WBBBarBundle:News:landingPage.html.twig', array(
            'city'      => $city,
            'latest'    => $latestNews,
            'articles'  => $articles,
            'interviews'=> $interviews,
            'newsList'  => $newsList,
            'topCities' => $topCities,
            'ads'       => $ads
        ));
    }

    public function detailsAction($newsSlug)
    {
        $this->reGeolocate();
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        $city = null;
        if (!empty($slug))
            $city = $this->get('city.repository')->findOneBySlug($slug);

        $news = $this->container->get('news.repository')->findOneBySlug($newsSlug);

        if (!$news) {
            throw $this->createNotFoundException('Object not found!');
        }

        $tmp1 = $this->container->get('news.repository')->findRelatedNews($news->getCitiesAsArray(), 3, array($news->getId()));
        $ids = array($news->getId());

        foreach($tmp1 as $tmp){
            $ids[] = $tmp->getId();
        }

        $tmp2 = $this->container->get('news.repository')->findRelatedNews(null, (3 - count($tmp1)), $ids);

        $alsoLike = array_merge($tmp1, $tmp2);

        return $this->render('WBBBarBundle:News:details.html.twig', array(
            'news'          => $news,
            'latestBars'    => $this->container->get('bar.repository')->findLatestBars($city, 5),
            'alsoLike'      => $alsoLike,
            'city'          => $city,
            'oneTopCity'    => $news->hasOnlyOneTopCity(),
        ));
    }

    public function shareAction(News $news)
    {
        $form = $this->container->get('wbb.forum.sharenews.form');
        $formHandler = $this->container->get('bmwi.forum.sharequestion.form.handler');

        $process = $formHandler->process($question);
        if ($process) {
            return $this->render('BMWiForumBundle:Question:confirmedShare.html.twig');
        }

        return array(
            'form'     => $form->createView(),
            'question' => $question
        );
    }
}
