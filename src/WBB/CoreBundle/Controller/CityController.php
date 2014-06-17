<?php

namespace WBB\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * CityController
 */
class CityController extends Controller
{
    public function citiesAction()
    {
        return $this->render('WBBCoreBundle:City:cities.html.twig');
    }
}
