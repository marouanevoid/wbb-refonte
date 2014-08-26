<?php
    namespace WBB\BarBundle\EventListener;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Event\LifecycleEventArgs;
    use WBB\BarBundle\Entity\Bar;

class BarListener
{
    private $_em;

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->_em = $args->getEntityManager();

        if ($entity instanceof Bar) {
            $entity = $this->updateBarRanking($entity);
            $entity = $this->disableIncompleteBars($entity);
        }

    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $this->_em = $args->getEntityManager();

        if ($entity instanceof Bar) {
            $entity = $this->updateBarRanking($entity);
            $entity = $this->disableIncompleteBars($entity);
        }

    }

    private function updateBarRanking(Bar $bar)
    {
        $maxFBCheckIns  = $this->_em->getRepository('WBBBarBundle:Bar')->findMaxValueOf('facebookCheckIns');
        $maxFSCheckIns  = $this->_em->getRepository('WBBBarBundle:Bar')->findMaxValueOf('foursquareCheckIns');
        $maxFBLikes     = $this->_em->getRepository('WBBBarBundle:Bar')->findMaxValueOf('facebookLikes');
        $maxFSLikes     = $this->_em->getRepository('WBBBarBundle:Bar')->findMaxValueOf('foursquareLikes');

        $ranking = (
            ((double) $bar->getFoursquareCheckIns() / (double) (($maxFSCheckIns>0)? $maxFSCheckIns : 1)) * 2 +
            ((double) $bar->getFacebookCheckIns() / (double) (($maxFBCheckIns>0)? $maxFBCheckIns : 1)) * 2 +
            ((double) $bar->getFoursquareLikes() / (double) (($maxFSLikes>0)? $maxFSLikes : 1)) * 3 +
            ((double) $bar->getFacebookLikes() / (double) (($maxFBLikes>0)? $maxFBLikes : 1)) * 3
        );

        $bar->setRanking((double) $ranking);

        return $bar;
    }

    private function disableIncompleteBars(Bar $bar)
    {
        if (!$bar->getCity() || !$bar->getSuburb()) {
            $bar->setStatus(Bar::BAR_STATUS_PENDING_VALUE);
        }

        return $bar;
    }

}
