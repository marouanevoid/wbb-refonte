<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WBB\BarBundle\Entity\Tip;
use WBB\BarBundle\Form\TipType;

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
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $tip = new Tip();
        $tip
            ->setUser($user)
            ->setStatus(1);

        $form = $this->createForm(new TipType(), $tip, array('em' => $this->container->get('doctrine.orm.entity_manager')));

        if ('POST' === $request->getMethod()) {
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tip);
                $em->flush();

                $tipHTML = $this->renderView('WBBBarBundle:Bar:tip.html.twig', array('tip' => $tip));

                return new JsonResponse(array(
                    'code'=>200,
                    'message'=>'Tip submitted!',
                    'tip' => $tipHTML
                ));
            }
            else
            {
                return new JsonResponse(array('code'=>500, 'message'=>'Unknown Error!'));
            }
        }
    }

    public function loadTipsAction($barID, $offset = 3, $limit = 8)
    {
        $bar    = $this->container->get('bar.repository')->findOneById($barID);
        $tips   = $this->container->get('tip.repository')->findLatestTips($bar, $offset, $limit);
        $all    = $this->container->get('tip.repository')->findLatestTips($bar, $offset, 0);

        $response['nbResults']= count($tips);
        $response['difference']= count($all) - count($tips);
        $response['htmldata'] = $this->renderView('WBBBarBundle:Bar:wbbTips.html.twig', array(
                'bar'       => $bar,
                'tips'      => $tips,
                'offset'    => $offset,
                'limit'     => $limit
            )
        );

        return new JsonResponse($response);
    }
}
