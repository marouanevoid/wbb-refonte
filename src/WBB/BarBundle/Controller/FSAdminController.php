<?php

namespace WBB\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * FSAdminController
 */
class FSAdminController extends Controller
{

    public function testFSAction($venue)
    {
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
     * listAction
     *
     * @Route(
     *     "/list/{type}",
     *     options={ "expose": true }
     * )
     * @param $type
     * @param Request $request
     * @internal param string $from
     *
     * @return JsonResponse
     */
    public function listAction($type, Request $request)
    {
        $next = $request->query->get('next', null);

        return new JsonResponse($this->get("wbb.foursquare.feed")->find($next));
    }

    /**
     * addAction
     *
     * @Route(
     *     "/add/{type}/{hash}/{thematic_id}",
     *     defaults={"thematic_id" = null},
     *     options={ "expose": true }
     * )
     * @ParamConverter("thematic", options={"mapping": {"thematic_id": "id"}})
     *
     * @param $type
     * @param string $hash
     * @param Thematic $thematic
     *
     * @return JsonResponse
     */
    public function addAction($type, $hash, Thematic $thematic = null)
    {
        $feed = $this->get("bmwi.$type.feed")->createFeed($hash, $thematic);
        $em = $this->getDoctrine()->getManager();
        $em->persist($feed);
        $em->flush();

        return new JsonResponse(array('feed' => $feed->getId()));
    }

    /**
     * getFacebookFeedAction
     *
     * @Route("/getFacebookFeed")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function getFacebookFeedAction(Request $request)
    {
        $pagination = urldecode($request->request->get('url'));

        $storedStatues   = $this->get('feed.repository')->findStoredFeedHashs("Facebook");

        //quick function to get the latest facebook status
        $data = $this->get('bmwi.facebook.feed')->loadFBStatues($pagination);

        $feeds    = $data->data;
        $next     = $this->get('bmwi.facebook.feed')->checkFacebookPagination($data->paging->next);

        $statues = array();
        foreach ($feeds as $feed) {
            if (!in_array($feed->id, $storedStatues)) {
                if (!isset($feed->story)) {
                    $statues[] = array(
                        'id'           => $feed->id,
                        'updated_time' => $feed->updated_time,
                        'message'      => $this->get('bmwi.facebook.feed')->parseFacebook($feed)
                    );
                }
            }
        }

        $response = array(
            'admin_pool'   => $this->container->get('sonata.admin.pool'),
            'statues'      => $statues,
            'selectWidget' => $this->getSelectThematic(),
            'next'         => $next
        );

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse($response);
        }

        return $this->render('BMWiForumBundle:Admin:Feed/facebookList.html.twig',$response);
    }

    /**
     * saveFacebookFeedAction
     *
     * @Route("/addFacebookFeed")
     *
     * @internal param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return Response
     */
    public function saveFacebookFeedAction()
    {
        $request = $this->getRequest();

        $idThematic = $request->get('idThematic');
        $thematic = null;

        if ($idThematic > 0) {
            $thematic = $this->get('thematic.repository')->findOneById($idThematic);
        }

        $hash = $request->get('hash');

        $statu = $this->get('bmwi.facebook.feed')->getStatu($hash);

        $feed = $this->get('bmwi.facebook.feed')->createFeed($statu, $hash, $thematic);
        $_em = $this->getDoctrine()->getManager();
        $_em->persist($feed);
        $_em->flush();

        return new JsonResponse(array('feed' => $feed->getId(),'thematic' => $idThematic));
    }

    private function getSelectThematic()
    {
        $activeThematics = $this->get('thematic.repository')->findBy(array('enabled' => true));
        $selectWidget = "";
        foreach ($activeThematics as $activeThematic) {
            $selectWidget .= sprintf("<option value='%s' >%s</option>", $activeThematic->getId(), $activeThematic->getTitle());
        }

        return sprintf('<select><option value="0"></option>%s</select>', $selectWidget);
    }

}
