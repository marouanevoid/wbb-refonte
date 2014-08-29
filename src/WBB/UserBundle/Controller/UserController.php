<?php

namespace WBB\UserBundle\Controller;

use Ddeboer\DataImport\Reader\CsvReader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use WBB\BarBundle\Form\SemsoftType;
use WBB\UserBundle\Entity\User;

class UserController extends Controller
{

    public function simulateErrorAction($code)
    {
        if ($code === '404') {
            throw new NotFoundHttpException;
        } else {
            throw new \Exception;
        }

    }

    public function importFormAction()
    {
        $form = $this->createImportForm();

        return $this->render('WBBBarBundle:Block:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function createImportForm()
    {
        $form = $this->createForm(new SemsoftType(), array(), array(
            'action' => $this->generateUrl('wbb_users_import'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Import'));

        return $form;
    }

    public function importAction(Request $request)
    {
        $form = $this->createImportForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $fullImport = true;

            $em = $this->getDoctrine()->getManager();
            $userManager = $this->container->get('fos_user.user_manager');
            $file = $form->getData();

            $file['file']->move('uploads/csv', 'users.csv');
            $file = new \SplFileObject($this->container->getParameter('kernel.root_dir').'/../web/uploads/csv/users.csv');
            $reader = new CsvReader($file, ',');
            $outPut = $this->createOutPutStream();

            $reader->setHeaderRowNumber(0);
            foreach ($reader as $data)
            {
                try{
                    $user = new User();

                    $user
                        ->setUsername($data['Pseudo'])
                        ->setEmail($data['Email'])
                        ->setBirthdate(new \DateTime($data['Birth Date']))
                    ;

                    if(trim($data['Password']) == '') {
                        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
                        $user->setConfirmationToken($tokenGenerator->generateToken());
                        $data['Reset URL'] = $this->get('router')->generate('fos_user_resetting_reset', array('token' => $user->getConfirmationToken()), true);
                        $user->setPassword($user->getConfirmationToken());
                        $user->setPasswordRequestedAt(new \DateTime());
                        fputcsv($outPut, $data, ',');
                        $fullImport = false;
                    }else{
                        $user->setPassword($data['Password']);
                    }

                    $errors = $this->get('validator')->validate($user, array('wbb_user_import'));
                    if(count($errors) > 0){
                        fputcsv($outPut, $data, ',');
                        $fullImport = false;
                    }else{
                        $userManager->updateUser($user, false);
                    }

                    $em->flush();

                }catch (\Exception $e){
                    fputcsv($outPut, $data, ',');
                    $fullImport = false;
                }
            }

            if($fullImport){
                $this->get('session')->getFlashBag()->add('sonata_flash_success', 'Users successfully imported');
                return new RedirectResponse($this->get('router')->generate('admin_wbb_user_user_list'));
            }else{
                $content = stream_get_contents($outPut);
                fclose($outPut);

                return new Response($content, 200, array(
                    'Content-Type' => 'application/force-download',
                    'Content-Disposition' => 'attachment; filename="export.csv"'
                ));
            }

        }else{
            $this->get('session')->getFlashBag()->add('sonata_flash_error', 'Errors during import : File not valid !');
            return new RedirectResponse($this->get('router')->generate('sonata_admin_homepage'));
        }
    }

    public function resendEmailConfirmationTokenAction()
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $this->get('fos_user.mailer')->sendConfirmationEmailMessage($user);

        return new JsonResponse(array(
            'code' => 200,
            'message' => 'Confirmation email sent !'
        ));
    }

    public function loadProfileDataAction($content = 1, $filter = "date" , $offset = 0, $limit = 8, $display = 'grid')
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(array(
                'code' => 403,
                'message' => 'User not authenticated !'
            ));
        }

        $response           = null;
        $all                = null;
        $nbResults          = null;
        $nbResultsRemaining = null;
        $html               = null;
        $distance           = false;

        if ($content == "bars") {
            $session = $this->container->get('session');
            $latitude = $session->get('userLatitude' );
            $longitude = $session->get('userLongitude');
            if(!empty($latitude) && !empty($longitude))
                $distance = array(
                    'latitude'  => $latitude,
                    'longitude' => $longitude,
                    'city'      => $this->get('city.repository')->findOneBySlug($session->get('citySlug'))
                );

            if ($filter === "alphabetical") {
                $response = $this->container->get('bar.repository')->findBarsOrderedByName(null, $offset, $limit, $user);
                $all = $this->container->get('bar.repository')->findBarsOrderedByName(null, $offset, 0, $user);
            } elseif ($filter === "date") {
                $response = $this->container->get('bar.repository')->findLatestBars(null, $limit, $offset, false, $user);
                $all = $this->container->get('bar.repository')->findLatestBars(null, 0, $offset, false, $user);
            } elseif ($filter === "city") {
                $response = $this->container->get('bar.repository')->findBarsOrderedByCityAndName($user, $offset, $limit);
                $all = $this->container->get('bar.repository')->findBarsOrderedByCityAndName($user, $offset, 0);
            }

            if ($display=="grid") {
                $html = $this->renderView('WBBUserBundle:Profile:filters\bars.html.twig', array(
                        'bars'   => $response,
                        'offset' => $offset,
                        'limit'  => $limit,
                        'distance' => $distance
                    )
                );
            } else {
                $html = $this->renderView('WBBUserBundle:Profile:filters\barsList.html.twig', array(
                    'bars'   => $response,
                    'offset' => $offset,
                    'limit'  => $limit,
                    'distance' => $distance
                ));
            }

        } elseif ($content == "bestofs") {

            if ($filter === "city") {
                $response = $this->container->get('bestof.repository')->findBarsOrderedByCityAndName($user, $offset, $limit);
                $all = $this->container->get('bestof.repository')->findBarsOrderedByCityAndName($user, $offset, 0);
            } elseif ($filter === "alphabetical") {
                $response = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset ,$limit, 'ASC', $user);
                $all = $this->container->get('bestof.repository')->findBestofOrderedByName(null, $offset , 0, 'ASC', $user);
            } elseif ($filter === "date") {
                $response = $this->container->get('bestof.repository')->findLatestBestofs(null, $limit, $offset, false, $user);
                $all = $this->container->get('bestof.repository')->findLatestBestofs(null, 0, $offset, false, $user);
            }
            if ($display=="grid") {
                $html = $this->renderView('WBBUserBundle:Profile/filters:bestofs.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            } else {
                $html = $this->renderView('WBBUserBundle:Profile/filters:bestofsList.html.twig', array(
                    'bestofs' => $response,
                    'offset'  => $offset,
                    'limit'   => $limit
                ));
            }
        } else {

            $response = $this->container->get('tip.repository')->findUserTips($user, $offset ,$limit);
            $all = $this->container->get('tip.repository')->findUserTips($user, $offset, 0);
            $html = $this->renderView('WBBUserBundle:Profile/filters:tip.html.twig', array(
                'tips'    => $response,
                'user'    => $user,
                'offset'  => $offset,
                'limit'   => $limit
            ));
        }

        $nbResults = count($response);
        $nbResultsRemaining = count($all) - $nbResults;

        return new JsonResponse(
            array(
                'htmldata'   => $html,
                'nbResults'  => $nbResults,
                'difference' => $nbResultsRemaining
            )
        );
    }

    private function createOutPutStream()
    {
        $handle = fopen('php://output', 'r+');

        fputcsv($handle, array(
            'Pseudo', 'Email', 'Password', 'Birth Date', 'Reset URL'), ',');
        return $handle;
    }
}
