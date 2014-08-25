<?php

namespace WBB\UserBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends ContainerAware
{
    /**
     * Show the user
     */
    public function showAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $session = $this->container->get('session');
        $city = $this->container->get('city.repository')->findOneBySlug($session->get('citySlug'));

        return $this->container->get('templating')->renderResponse('WBBUserBundle:Profile:show.html.twig', array(
                'user'  => $user,
                'city'  => $city
            )
        );
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request)
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $session = $this->container->get('session');
        if ($request->query->get('profileMessage', null)) {
            $session->getFlashBag()->add('wbb-complete-profile', true);
            return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_edit'));
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $mobileDetector = $this->container->get('mobile_detect.mobile_detector');

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('wbb_user.profile.form.factory');
        if(!$mobileDetector->isMobile() || $mobileDetector->isTablet()){
            $form = $formFactory->createForm(false, array('Default', 'registration_full'));
        }else{
            $form = $formFactory->createForm(true, array('profile_light'));
        }

        $form->setData($user);
        $errors = array('fields' => array(), 'messages' => array());

        if ('POST' === $request->getMethod()) {
            $form->bind($request);

            if ($form->isValid()) {
                /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
                $userManager = $this->container->get('fos_user.user_manager');

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

                if($user->getFirstname() != '' && $user->getLastname() != '' && $user->getConfirmed()){
                    $user->setTipsShouldBeModerated(false);
                }

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    $url = $this->container->get('router')->generate('fos_user_profile_show');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            } else {
                $formErrors = null;
                if(!$mobileDetector->isMobile() || $mobileDetector->isTablet()){
                    $formErrors = $this->container->get('validator')->validate($form, array('Default','registration_full'));
                }else{
                    $formErrors = $this->container->get('validator')->validate($form, array('Default', 'profile_light'));
                }

                $fields = array();
                $messages = array();

                foreach ($formErrors as $formError) {
                    $fields[] = str_replace('data.', '', $formError->getPropertyPath());
                    if ($formError->getMessage() == 'not.blank' && !in_array('Please complete all required fields', $messages)) {
                        $messages[] = 'Please complete all required fields';
                    } elseif($formError->getMessage() != 'not.blank' && !in_array($formError->getMessage(), $messages)) {
                        $messages[] = $formError->getMessage();
                    }
                }

                $errors = array(
                    'fields' => $fields,
                    'messages' => $messages
                );
            }
        }

        $city = $this->container->get('city.repository')->findOneBySlug($session->get('citySlug'));

        return $this->container->get('templating')->renderResponse(
            'WBBUserBundle:Profile:edit.html.'.$this->container->getParameter('fos_user.template.engine'),
            array(
                'form'   => $form->createView(),
                'user'   => $user,
                'city'   => $city,
                'errors' => $errors
            )
        );
    }
}
