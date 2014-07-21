<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TagController extends Controller
{
    public function getByTypeAction($typeID, $tagID)
    {
        $html = "";
        $tags = null;
        if($typeID > 0){
            $tags = $this->get('tag.repository')->findByType($typeID);
        }else{
            return new JsonResponse(array());
        }

        $i = 1;
        foreach($tags as $tag){
            if($tagID == $tag->getId())
                $html .= '<option value="'.$tag->getId().'" selected>'.$tag->getName().'</option>';
            else
                $html .= '<option value="'.$tag->getId().'" >'.$tag->getName().'</option>';

            $i++;
        }

        return new JsonResponse($html);
    }
}
