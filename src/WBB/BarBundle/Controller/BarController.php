<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use WBB\BarBundle\Entity\Bar;

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

        return $this->render('WBBBarBundle:Bar:details.html.twig', array(
            'bar' => $bar
        ));
    }
}
