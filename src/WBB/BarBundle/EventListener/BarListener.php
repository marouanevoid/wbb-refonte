<?php
    namespace WBB\BarBundle\EventListener;

    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Event\LifecycleEventArgs;
    use WBB\BarBundle\Entity\Bar;

class BarListener
{

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Bar) {
            $entity = $this->updateBarRanking($entity, $entityManager);
        }

    }

    public function preUpdate(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof Bar) {
            $entity = $this->updateBarRanking($entity, $entityManager);
        }

    }

    private function updateBarRanking(Bar $bar, EntityManager $entityManager)
    {
        $maxFBCheckIns  = $entityManager->getRepository('WBBBarBundle:Bar')->findMaxValueOf('facebookCheckIns');
        $maxFSCheckIns  = $entityManager->getRepository('WBBBarBundle:Bar')->findMaxValueOf('foursquareCheckIns');
        $maxFBLikes     = $entityManager->getRepository('WBBBarBundle:Bar')->findMaxValueOf('facebookLikes');
        $maxFSLikes     = $entityManager->getRepository('WBBBarBundle:Bar')->findMaxValueOf('foursquareLikes');

        $ranking = (
            ((double)$bar->getFoursquareCheckIns() / (double)$maxFSCheckIns) * 2 +
            ((double)$bar->getFacebookCheckIns() / (double)$maxFBCheckIns) * 2 +
            ((double)$bar->getFoursquareLikes() / (double)$maxFSLikes) * 3 +
            ((double)$bar->getFacebookLikes() / (double)$maxFBLikes) * 3
        );

        $bar->setRanking((double) $ranking);

        return $bar;
    }

}