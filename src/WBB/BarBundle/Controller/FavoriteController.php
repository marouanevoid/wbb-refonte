<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class FavoriteController extends Controller
{

    public function addBarAction($barId)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $bar = $em->getRepository('WBBBarBundle:Bar')
            ->findOneBy(array('id' => $barId));

        if (!$bar) {
            return new JsonResponse(array(
                'code' => 404,
                'message' => 'Bar not found !'
            ));
        }

        $bar->addUsersFavorite($user);
        $user->addFavoriteBar($bar);

        $em->persist($bar);
        $em->persist($user);
        $em->flush();

        return new JsonResponse(array(
            'code' => 200,
            'message' => 'Bar added to the current user !',
            'href' => $this->generateUrl('wbb_favorite_bar_delete', array(
                    'barId' => $barId
                ))
        ));
    }

    public function deleteBarAction($barId)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $bar = $em->getRepository('WBBBarBundle:Bar')
            ->findOneBy(array('id' => $barId));

        if (!$bar) {
            return new JsonResponse(array(
                'code' => 404,
                'message' => 'Bar not found !'
            ));
        }

        $bar->removeUsersFavorite($user);
        $user->removeFavoriteBar($bar);

        $em->persist($bar);
        $em->persist($user);
        $em->flush();

        return new JsonResponse(array(
            'code' => 200,
            'message' => 'Bar deleted from the favirites of the current user !',
            'href' => $this->generateUrl('wbb_favorite_bar_add', array(
                    'barId' => $barId
                ))
        ));
    }

    public function addBestOfAction($bestOfId)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $bestOf = $em->getRepository('WBBBarBundle:BestOf')
            ->findOneBy(array('id' => $bestOfId));

        if (!$bestOf) {
            return new JsonResponse(array(
                'code' => 404,
                'message' => 'BestOf not found !'
            ));
        }

        $bestOf->addUsersFavorite($user);
        $user->addFavoriteBestOf($bestOf);

        $em->persist($bestOf);
        $em->persist($user);
        $em->flush();

        return new JsonResponse(array(
            'code' => 200,
            'message' => 'BestOf added to the current user !',
            'href' => $this->generateUrl('wbb_favorite_bestof_delete', array(
                    'bestOfId' => $bestOfId
                ))
        ));
    }

    public function deleteBestOfAction($bestOfId)
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $em = $this->getDoctrine()->getManager();
        $bestOf = $em->getRepository('WBBBarBundle:BestOf')
            ->findOneBy(array('id' => $bestOfId));

        if (!$bestOf) {
            return new JsonResponse(array(
                'code' => 404,
                'message' => 'BestOf not found !'
            ));
        }

        $bestOf->removeUsersFavorite($user);
        $user->removeFavoriteBestOf($bestOf);

        $em->persist($bestOf);
        $em->persist($user);
        $em->flush();

        return new JsonResponse(array(
            'code' => 200,
            'message' => 'BestOf deleted from the favirites of the current user !',
            'href' => $this->generateUrl('wbb_favorite_bestof_add', array(
                    'bestOfId' => $bestOfId
                ))
        ));
    }

}