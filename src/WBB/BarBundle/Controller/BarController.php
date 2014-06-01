<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Repository\BarRepository;

class BarController extends Controller
{
    /**
     * detailsAction
     *
     * @param integer $id
     *
     * @return Response
     */
    public function detailsAction($id)
    {
        $bar = $this->container->get('bar.repository')->findOneById($id);
        
        $youMayAlsoLike = $this->container->get('bar.repository')->findYouMayAlsoLike($bar);
        $size = sizeof($youMayAlsoLike);

        if($size < 4)
        {
            $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar, BarRepository::BAR_LOCATION_COUNTRY, (4 - $size), $youMayAlsoLike);

            foreach($temp as $tmp){
                $youMayAlsoLike[] = $tmp;
            }

            $size += sizeof($temp);

            if($size < 4)
            {
                $temp = $this->container->get('bar.repository')->findYouMayAlsoLike($bar, BarRepository::BAR_LOCATION_WORLDWIDE, (4 - $size), $youMayAlsoLike);
                foreach($temp as $tmp){
                    $youMayAlsoLike[] = $tmp;
                }
            }
        }

        return $this->render('WBBBarBundle:Bar:details.html.twig', array(
            'bar'       => $bar,
            'barLike'   => $youMayAlsoLike
        ));
    }
}
