<?php

namespace WBB\BarBundle\Manager;

use Symfony\Component\DependencyInjection\ContainerAware;
use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\BestOf;
use WBB\UserBundle\Entity\User;

class FavoritesManager extends ContainerAware
{

    public function addToFavorites($id, $type)
    {
        $repo = '';
        switch ($type) {
            case 'bar':
                $repo = 'bar.repository';
                break;
            case 'best of':
                $repo = 'bestof.repository';
                break;
            default :
                return;
        }

        if ($repo != '') {
            $entity = $this->container->get($repo)->findOneBy(array('id' => $id));
            $token = $this->container->get('security.context')->getToken();
            if ($token) {
                $user = $token->getUser();
                $em = $this->container->get('doctrine.orm.entity_manager');

                if ($user instanceof User && $entity) {
                    if ($entity instanceof Bar) {
                        if (!$user->getFavoriteBars()->contains($entity)) {
                            $entity->addUsersFavorite($user);
                            $user->addFavoriteBar($entity);

                            $em->persist($entity);
                            $em->persist($user);
                            $em->flush();
                        }
                    } elseif ($entity instanceof BestOf) {
                        if (!$user->getFavoriteBestOfs()->contains($entity)) {
                            $entity->addUsersFavorite($user);
                            $user->addFavoriteBestOf($entity);

                            $em->persist($entity);
                            $em->persist($user);
                            $em->flush();
                        }
                    }
                }
            }
        }
    }

}
