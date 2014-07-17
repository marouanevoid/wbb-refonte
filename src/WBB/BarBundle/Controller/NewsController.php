<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WBB\BarBundle\Entity\Ad;
use WBB\BarBundle\Entity\News;

class NewsController extends Controller
{
    public function landingPageAction($citySlug = false)
    {
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

        $ad = new Ad();

        return $this->render('WBBBarBundle:News:landingPage.html.twig', array(
            'city'      => $city,
            'latest'    => $latestNews,
            'articles'  => $articles,
            'interviews'=> $interviews,
            'newsList'  => $newsList,
            'topCities' => $topCities,
            'ad'        => $ad,
            'bigAd'     => false
        ));
    }

    public function detailsAction($newsSlug)
    {
        $session = $this->container->get('session');
        $slug = $session->get('citySlug');
        $city = null;
        if (!empty($slug))
            $city = $this->get('city.repository')->findOneBySlug($slug);

        $news = $this->container->get('news.repository')->findOneBySlug($newsSlug);

        $alsoLike = $this->container->get('news.repository')->findRelatedNews($news->getCitiesAsArray(), 3, array($news->getId()));

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
