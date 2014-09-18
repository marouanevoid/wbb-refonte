<?php

namespace WBB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SitemapsController extends Controller
{

    public function sitemapAction()
    {
        $urls = array();

        $urls[] = array(
            'loc' => $this->get('router')->generate('homepage', array(), true),
            'changefreq' => 'daily',
            'priority' => '1.0'
        );

        $allUrls = array_merge(
                $urls, $this->getBarsUrls(), $this->getBestofsUrls(), $this->getCitiesUrls(), $this->getStaticsUrls(), $this->getNewsUrls()
        );

        return $this->render('WBBCoreBundle:Sitemaps:sitemap.xml.twig', array(
                    'urls' => $allUrls
        ));
    }

    private function getStaticsUrls()
    {
        $urls = array();

        $pagesRoutes = array(
            'wbb_cookies_policy',
            'wbb_about_us',
            'wbb_terms_and_conditions',
            'wbb_privacy_policy',
            'wbb_cookies_policy',
            'wbb_responsible_drinking'
        );

        foreach ($pagesRoutes as $route) {
            $urls[] = array(
                'loc' => $this->get('router')->generate($route, array(), true),
                'changefreq' => 'yearly',
                'priority' => '0.8'
            );
        }

        return $urls;
    }

    private function getBarsUrls()
    {
        $urls = array();

        $bars = $this->get('bar.repository')->findAll();
        foreach ($bars as $bar) {
            $city = $bar->getCity();
            $suburb = $bar->getSuburb();

            $urls[] = array(
                'loc' => $this->get('router')->generate('wbb_bar_details', array(
                    'city' => ($city ? $city->getSlug() : ''),
                    'suburb' => ($suburb ? $suburb->getSlug() : ''),
                    'slug' => $bar->getSlug()
                        ), true),
                'changefreq' => 'daily',
                'lastmod' => $bar->getUpdatedAt()->format('Y-m-d'),
                'priority' => '0.8'
            );
        }

        return $urls;
    }

    public function getNewsUrls()
    {
        $urls = array();

        $allNews = $this->get('news.repository')->findAll();

        foreach ($allNews as $news) {
            $urls[] = array(
                'loc' => $this->get('router')->generate('wbb_news_details_page', array(
                    'newsSlug' => $news->getSlug(),
                        ), true),
                'changefreq' => 'daily',
                'lastmod' => $news->getUpdatedAt()->format('Y-m-d'),
                'priority' => '0.8'
            );
        }

        return $urls;
    }

    private function getBestofsUrls()
    {
        $urls = array();

        $bestofs = $this->get('bestof.repository')->findAll();
        foreach ($bestofs as $bestof) {
            $city = $bestof->getCity();
            if ($city) {
                $url = $this->get('router')->generate('wbb_bar_bestof_local', array(
                    'bestOfSlug' => $bestof->getSlug(),
                    'citySlug' => $city->getSlug()
                        ), true);
            } else {
                $url = $this->get('router')->generate('wbb_bar_bestof_global', array(
                    'bestOfSlug' => $bestof->getSlug()
                        ), true);
            }

            $urls[] = array(
                'loc' => $url,
                'changefreq' => 'daily',
                'lastmod' => $bestof->getUpdatedAt()->format('Y-m-d'),
                'priority' => '0.8'
            );
        }

        return $urls;
    }

    private function getCitiesUrls()
    {
        $urls = array();

        $cities = $this->get('city.repository')->findAll();
        foreach ($cities as $city) {
            if ($city->getOnTopCity() || $city->getBars()->count() > 0) {
                $url = $this->get('router')->generate('city_homepage', array(
                    'slug' => $city->getSlug()
                        ), true);

                $urls[] = array(
                    'loc' => $url,
                    'changefreq' => 'daily',
                    'lastmod' => $city->getUpdatedAt()->format('Y-m-d'),
                    'priority' => '0.8'
                );
            }
            $url = $this->get('router')->generate('wbb_cities_city', array(
                'slug' => $city->getSlug()
                    ), true);
            $urls[] = array(
                'loc' => $url,
                'changefreq' => 'daily',
                'lastmod' => $city->getUpdatedAt()->format('Y-m-d'),
                'priority' => '0.8'
            );
            $urls = array_merge($urls, $this->getCitySuburbsUrls($city));
        }

        return $urls;
    }

    private function getCitySuburbsUrls($city)
    {
        $urls = array();

        foreach ($city->getSuburbs() as $suburb) {
            $urls[] = array(
                'loc' => $this->get('router')->generate('wbb_cities_city', array(
                    'slug' => $city->getSlug(),
                    'suburb' => $suburb->getSlug()
                        ), true),
                'changefreq' => 'daily',
                'lastmod' => $suburb->getUpdatedAt()->format('Y-m-d'),
                'priority' => '0.8'
            );
        }

        return $urls;
    }

}
