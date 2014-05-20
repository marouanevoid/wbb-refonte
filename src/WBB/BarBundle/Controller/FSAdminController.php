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

    public function testFSAction($venue)
    {
        $client = new Client("https://api.instagram.com/v1/users/3/media/recent/?client_id=03af4f044b524a4ca9958053b7a6cb18");

        $request = $client->get();

        var_dump($request->send());die;

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
     * @return JsonResponse
     */
    public function findAction($type, $id)
    {
        return new JsonResponse($this->get("wbb.{$type}.feed")->find($id));
    }

    /**
     * listAction
     *
     * @param $type
     * @param \WBB\BarBundle\Entity\Bar $bar
     *
     * @return JsonResponse
     */
    public function listAction($type, $bar)
    {
        return new JsonResponse($this->get("wbb.{$type}.feed")->listAll($bar));
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
        $feed = $this->get("wbb.$type.feed")->createObject($hash, $bar);

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
        $objects = $this->get("wbb.$type.feed")->removeObject($hash, $bar);

        return new JsonResponse(array('objects' => $objects));
    }
}
