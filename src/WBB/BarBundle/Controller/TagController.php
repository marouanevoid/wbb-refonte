<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TagController extends Controller
{
    public function getByTypeAction($typeID, $tagID)
    {
        $html = "";
        $tags = null;
        if ($typeID > 0) {
            $tags = $this->get('tag.repository')->findByType($typeID);
        } else {
            return new JsonResponse(array());
        }

        $i = 1;
        foreach ($tags as $tag) {
            if($tagID == $tag->getId())
                $html .= '<option value="'.$tag->getId().'" selected>'.$tag->getName().'</option>';
            else
                $html .= '<option value="'.$tag->getId().'" >'.$tag->getName().'</option>';

            $i++;
        }

        return new JsonResponse($html);
    }

    public function getBrandsByNameAction($type, Request $request)
    {
        $term = $request->get('term');
        $tags = $this->container->get('tag.repository')->findByType($type, false, 5, $term, false);

        $json = array();

        foreach ($tags as $tag) {
            $json[] = array(
                'value' => $tag->getName(),
                'id'    => $tag->getName()
            );
        }

        return new JsonResponse($json);
    }
}
