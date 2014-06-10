<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
//        $idUser = $this->getUser()->getId();
        $user = $this->container->get('user.repository')->findOneById(1);

        $tip = new Tip();
        $tip
            ->setUser($user)
            ->setStatus(0);

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
}
