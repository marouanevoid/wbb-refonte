<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use WBB\BarBundle\Entity\Bar;

/**
 * FeedController
 */
class FeedController extends Controller
{

    /**
     * showAction
     *
     * @param $type
     * @param $barSlug
     * @param  int $offset
     *
     * @return JsonResponse
     */
    public function showAction($type, $barSlug, $offset = 0)
    {
        $bar = $this->get('bar.repository')->findOneBySlug($barSlug);
        if (!$bar) {
            return new JsonResponse(null);
        } else {
            return new JsonResponse($this->get("wbb.{$type}.feed")->showList($bar, $offset));
        }
    }

    /**
     * findAction
     *
     * @param $type
     * @param $id
     *
     * @param  int          $offset
     * @return JsonResponse
     */
    public function findAction($type, $id, $offset = 0)
    {
        if (is_numeric($id) && $id==0) {
            return new JsonResponse(null);
        } else {
            return new JsonResponse($this->get("wbb.{$type}.feed")->find($id, $offset));
        }
    }

    /**
     * findAction
     *
     * @param $type
     * @param $hash
     *
     * @return JsonResponse
     */
    public function findHashAction($type, $hash)
    {

        if (!$hash || $hash === '') {
            return new JsonResponse(null);
        } else {
            return new JsonResponse($this->get("wbb.{$type}.feed")->findByHash($hash));
        }
    }

    /**
     * listAction
     *
     * @param $type
     * @param \WBB\BarBundle\Entity\Bar $bar
     *
     * @return JsonResponse
     */
    public function listAction($type, Bar $bar)
    {
        $entity = $this->getEntity($bar, 'bar');

        return new JsonResponse($this->get("wbb.{$type}.feed")->listAll($entity));
    }

    /**
     * addAction
     *
     * @param $type
     * @param string                    $hash
     * @param \WBB\BarBundle\Entity\Bar $bar
     *
     * @return JsonResponse
     */
    public function addAction($type, $hash, Bar $bar = null)
    {
        $entity = $this->getEntity($bar, 'bar');
        $feed = $this->get("wbb.$type.feed")->createObject($hash, $entity);

        return new JsonResponse(array('feed' => $feed->getId()));
    }

    /**
     * removeAction
     *
     * @param $type
     * @param string                    $hash
     * @param \WBB\BarBundle\Entity\Bar $bar
     *
     * @return JsonResponse
     */
    public function removeAction($type, $hash, Bar $bar = null)
    {
        $entity = $this->getEntity($bar, 'bar');
        $objects = $this->get("wbb.$type.feed")->removeObject($hash, $entity);

        return new JsonResponse(array('objects' => $objects));
    }

    public function tipsAction($barID, $offset, $limit)
    {
        $bar    = $this->container->get('bar.repository')->findOneById($barID);
        $allTips    = $this->container->get('tip.repository')->findLatestTips($bar, 0, 0);
        $all    = $this->container->get('tip.repository')->findLatestTips($bar, $offset, 0);
        $tips   = $this->container->get('tip.repository')->findLatestTips($bar, $offset, $limit, true);
        $allExpertTips   = $this->container->get('tip.repository')->findLatestTips($bar, 0, 0, true);
        $nbExpertTips = count($tips);
        if ($nbExpertTips < $limit) {
            $normalTips   = $this->container->get('tip.repository')->findLatestTips($bar, ($offset + $nbExpertTips - count($allExpertTips)), ($limit - $nbExpertTips), false, true);
            $tips = array_merge($tips, $normalTips);
        }
        $nbResults  = count($tips);
        $difference = count($all) - count($tips);
        $FsTips = array();
        $excludedCount = 0;
        if (($nbResults < $limit) && !is_null($bar->getFoursquare()) && $bar->getFoursquare() != "") {

            $excluded = $bar->getFsExcludedTips();
            $index = 0;
            $count = $offset - count($allTips);
            $recursive = 0;
            do {
                $tab = $this->get("wbb.fstips.feed")->find($bar->getFoursquare(), $count);
                $tmp = $tab['data'];
                $nbFsTips = count($tmp);
                if ($nbFsTips <= $index && !$nbFsTips)
                    break;
                foreach ($tmp as $key => $FsTip) {
                    if ($index == ($limit - $nbResults) ) {
                        $difference = 1;
                        break;
                    }

                    if (!in_array($FsTip['id'], $excluded)) {
                        $FsTips[] = $tmp[$key];
                        ++$index;
                    } else {
                        $excludedCount++;
                    }
                }
                $count += $nbFsTips;
                $recursive++;
            } while (($index < ($limit - $nbResults)) && $recursive < 5);
            $nbResults += $index;
        }
        $htmldata = $this->renderView('WBBBarBundle:Bar:tips.html.twig', array(
                'tips'      => $tips,
                'FsTips'    => $FsTips
            )
        );

        return new JsonResponse(
            array(
                'nbResults'  => $nbResults,
                'difference' => $difference,
                'htmldata'   => $htmldata,
                'excluded'   => $excludedCount
            )
        );
    }

    /**
     * Gets an entity based on a id
     */
    private function getEntity($id, $entityName)
    {
        $entity = $this->container->get("$entityName.repository")->findOneById($id);
        if (!$entity) {
            throw $this->createNotFoundException("$entityName with id: $id not found!");
        }

        return $entity;
    }
}
