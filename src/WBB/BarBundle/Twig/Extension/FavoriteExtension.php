<?php

namespace WBB\BarBundle\Twig\Extension;

use WBB\BarBundle\Entity\Bar;
use WBB\BarBundle\Entity\BestOf;
use FOS\UserBundle\Model\UserInterface;

class FavoriteExtension extends \Twig_Extension
{

    private $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    public function getName()
    {
        return 'favorite_extension';
    }

    public function getFunctions()
    {
        return parent::getFunctions() + array(
            'favorite_url' => new \Twig_Function_Method($this, 'getFavoriteUrl'),
            'is_favorite' => new \Twig_Function_Method($this, 'isFavorite')
        );
    }

    public function getFavoriteUrl($user, $object)
    {
        if ($object instanceof Bar) {
            return $this->barFavoriteUrl($user, $object);
        } else if ($object instanceof BestOf) {
            return $this->bestOfFavoriteUrl($user, $object);
        }
    }

    public function isFavorite($user, $object)
    {
        if ($object instanceof Bar) {
            return $this->isBarFavorite($user, $object);
        } else if ($object instanceof BestOf) {
            return $this->isBestOfFavorite($user, $object);
        }
    }

    private function barFavoriteUrl($user, Bar $bar)
    {
        if ($user instanceof UserInterface) {
            if ($user->getFavoriteBars()->contains($bar)) {
                return $this->router->generate('wbb_favorite_bar_delete', array(
                            'barId' => $bar->getId()
                ));
            } else {
                return $this->router->generate('wbb_favorite_bar_add', array(
                            'barId' => $bar->getId()
                ));
            }
        }

        return $this->router->generate('wbb_favorite_bar_add', array(
                    'barId' => $bar->getId()
        ));
    }

    private function isBarFavorite($user, Bar $bar)
    {
        if ($user instanceof UserInterface) {
            if ($user->getFavoriteBars()->contains($bar)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    private function bestOfFavoriteUrl($user, BestOf $bestOf)
    {
        if ($user instanceof UserInterface) {
            if ($user->getFavoriteBestOfs()->contains($bestOf)) {
                return $this->router->generate('wbb_favorite_bestof_delete', array(
                            'bestOfId' => $bestOf->getId()
                ));
            } else {
                return $this->router->generate('wbb_favorite_bestof_add', array(
                            'bestOfId' => $bestOf->getId()
                ));
            }
        }

        return $this->router->generate('wbb_favorite_bestof_add', array(
                    'bestOfId' => $bestOf->getId()
        ));
    }

    private function isBestOfFavorite($user, BestOf $bestOf)
    {
        if ($user instanceof UserInterface) {
            if ($user->getFavoriteBestOfs()->contains($bestOf)) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

}
