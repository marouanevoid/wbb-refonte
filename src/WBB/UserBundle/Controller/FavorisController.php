<?php

namespace WBB\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * FavorisController
 */
class FavorisController extends Controller
{
    public function addAction()
    {
        return new JsonResponse(array('error' => 0));
    }
}
