<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use WBB\BarBundle\Entity\Tip;
use WBB\BarBundle\Form\TipType;
use WBB\BarBundle\TipsEvents;
use WBB\BarBundle\Event\TipEvent;

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
        $tip->setUser($user);
        if ($user->getTipsShouldBeModerated()) {
            $tip->setStatus(0);
        } else {
            $tip->setStatus(1);
        }

        $form = $this->createForm(new TipType(), $tip, array('em' => $this->container->get('doctrine.orm.entity_manager')));

        if ('POST' === $request->getMethod()) {
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tip);
                $em->flush();

                $event = new TipEvent($tip);
                $dispatcher = $this->get('event_dispatcher');
                $dispatcher->dispatch(TipsEvents::TIP_CREATED, $event);

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

    public function deleteAction($tipId)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $tip = $em->getRepository('WBBBarBundle:Tip')
            ->findOneBy(array('id' => $tipId));

        if (!$tip) {
            return new JsonResponse(array(
                'code' => 404,
                'message' => 'Tip not found !'
            ));
        }

        $user->removeTip($tip);

        $em->persist($user);
        $em->remove($tip);
        $em->flush();

        return new JsonResponse(array(
            'code' => 200,
            'message' => 'Tip deleted !',
            'tipId' => $tipId
        ));
    }
}
