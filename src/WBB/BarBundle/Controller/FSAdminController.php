<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Guzzle\Http\Client;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use WBB\BarBundle\Entity\Bar;

/**
 * FSAdminController
 */
class FSAdminController extends Controller
{

    public function testFSAction()
    {
        $client = new Client("https://api.instagram.com");

        $response = $client->get("/v1/users/search?q=_mangetsu_&client_id=03af4f044b524a4ca9958053b7a6cb18")->send();

        $data = json_decode($response->getBody());
        $temp = $data->data[0]->id;

        var_dump($temp);die;

        $params = array( 'venue_id' => $venue, 'limit' => 4);

        //if($next > 0) $params['offset'] = $next;

        $client = $this->container->get('jcroll_foursquare_client');
        $command = $client->getCommand('venues/tips', $params);
        $tips = $command->execute();

        return new JsonResponse(array(
            'type' => 'fsTips',
            'data' => $tips['response']['tips']['items']
        ));
    }

    /**
     * findAction
     *
     * @param $type
     * @param $id
     *
     * @param int $offset
     * @return JsonResponse
     */
    public function findAction($type, $id, $offset = 0)
    {

        if(is_numeric($id) && $id==0){
            return new JsonResponse(null);
        }else{
            return new JsonResponse($this->get("wbb.{$type}.feed")->find($id, $offset));
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
     * @param string $hash
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
     * @param string $hash
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

        $tips   = $this->container->get('tip.repository')->findLatestTips($bar, $offset, $limit);
        $all    = $this->container->get('tip.repository')->findLatestTips($bar, $offset, 0);

        $nbResults  = count($tips);

        $difference = count($all) - count($tips);
        $FsTips = array();
        if(($nbResults < $limit) and !is_null($bar->getFoursquare()) and $bar->getFoursquare() != ""){
            $excluded = $bar->getFsExcludedTips();
            $index = 0;
            $count = $offset;
            $recursive = 0;
            do{
                $tab = $this->get("wbb.fstips.feed")->find($bar->getFoursquare(), $count);
                $tmp = $tab['data'];
                $nbFsTips = count($tmp);
                if ($nbFsTips <= $index && !$nbFsTips)
                    break;
                foreach($tmp as $key => $FsTip){
                    if($index == ($limit - $nbResults) ){
                        $difference = 1;
                        break;
                    }

                    if(!in_array($FsTip['id'], $excluded)){
                        $FsTips[] = $tmp[$key];
                        ++$index;
                    }
                }
                $count += $nbFsTips;
                $recursive++;
            }while(($index < ($limit - $nbResults)) and $recursive < 5);
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
