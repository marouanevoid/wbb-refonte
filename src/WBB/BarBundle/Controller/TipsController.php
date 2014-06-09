<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * TipsController
 */
class TipsController extends Controller
{
    /**
     * addAction
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return JsonResponse
     */
    public function addAction(Request $request)
    {
        $tip = $request->request->get('tip');

        if(strlen($tip) < 500 and strlen($tip) > 0){
            return new JsonResponse(array('code'=>200, 'message'=>'Tip submitted!'));
        }
        else{
            return new JsonResponse(array('code'=>300, 'message'=>'Tip is empty'));
        }
    }
}
